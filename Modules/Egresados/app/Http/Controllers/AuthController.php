<?php

namespace Modules\Egresados\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Redirige al login unificado del ERP o directo al panel si ya está autenticado.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        $redirect = $request->query('redirect', route('egresados.dashboard_egresado'));
        return redirect()->route('login', ['redirect' => $redirect]);
    }

    /**
     * Procesa la autenticación institucional del egresado/usuario en SIGE.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'El correo, usuario o documento es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $loginInput = trim($request->input('email'));
        $password = trim($request->input('password'));
        $remember = $request->boolean('remember');

        // =========================================================================
        // A. ACCESO DIRECTO PARA EGRESADOS CON NÚMERO DE CÉDULA
        // Permite que cualquier egresado registrado en el sistema ingrese usando
        // su cédula como usuario y también como contraseña.
        // =========================================================================
        $cleanDoc = preg_replace('/\D/', '', $loginInput);
        if (!empty($cleanDoc) && strlen($cleanDoc) >= 5) {
            $person = \Modules\SICA\Entities\Person::where('document_number', $cleanDoc)
                ->orWhere('document_number', (int)$cleanDoc)
                ->first();

            if (!$person && class_exists('\Modules\SICA\Entities\Apprentice')) {
                $apprentice = \Modules\SICA\Entities\Apprentice::whereHas('person', function($q) use ($cleanDoc) {
                    $q->where('document_number', $cleanDoc)->orWhere('document_number', (int)$cleanDoc);
                })->with('person')->first();
                if ($apprentice && $apprentice->person) {
                    $person = $apprentice->person;
                }
            }

            if ($person) {
                $isDocPassword = ($password === (string)$person->document_number || $password === $cleanDoc || $password === $loginInput);

                $user = User::where('person_id', $person->id)->first();
                if (!$user && !empty($person->misena_email)) {
                    $user = User::where('email', $person->misena_email)->first();
                }
                if (!$user && !empty($person->personal_email)) {
                    $user = User::where('email', $person->personal_email)->first();
                }
                if (!$user) {
                    $user = User::where('nickname', 'egresado_' . $cleanDoc)->first();
                }

                $canAuthenticate = false;
                if ($isDocPassword) {
                    $canAuthenticate = true;
                } elseif ($user && Hash::check($password, $user->password)) {
                    $canAuthenticate = true;
                }

                if ($canAuthenticate) {
                    if (!$user) {
                        $uniqueEmail = !empty($person->misena_email) 
                            ? $person->misena_email 
                            : (!empty($person->personal_email) ? $person->personal_email : 'egresado.' . $cleanDoc . '@sena.edu.co');

                        if (User::where('email', $uniqueEmail)->exists()) {
                            $uniqueEmail = 'egresado.' . $cleanDoc . '.' . time() . '@sena.edu.co';
                        }

                        $user = new User();
                        $user->nickname = 'egresado_' . $cleanDoc;
                        $user->person_id = $person->id;
                        $user->email = $uniqueEmail;
                    }

                    $user->password = Hash::make($cleanDoc);
                    $user->person_id = $person->id;
                    $user->save();

                    try {
                        $roleEgresado = \Modules\SICA\Entities\Role::where('slug', 'egresados.egresado')->first();
                        if (!$roleEgresado) {
                            $appEgresados = \DB::table('apps')->where('name', 'like', '%Egresados%')->orWhere('url', 'like', '%egresados%')->first();
                            $appId = $appEgresados ? $appEgresados->id : 30;
                            $roleEgresado = \Modules\SICA\Entities\Role::firstOrCreate(
                                ['slug' => 'egresados.egresado'],
                                [
                                    'name' => 'Egresado',
                                    'description' => 'Graduado / Egresado de formación profesional del CEFA',
                                    'description_english' => 'Graduate / Alumni of vocational training at CEFA',
                                    'full_access' => 'No',
                                    'app_id' => $appId,
                                ]
                            );
                        }
                        if ($roleEgresado && method_exists($user, 'roles')) {
                            $user->roles()->syncWithoutDetaching([$roleEgresado->id]);
                        }
                    } catch (\Throwable $e) {
                    }

                    Auth::login($user, $remember);
                    $request->session()->regenerate();

                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('success', '¡Bienvenido(a) a tu Portal de Egresados, ' . ($user->full_name ?: $person->full_name) . '!');
                }
            }
        }

        // =========================================================================
        // B. AUTENTICACIÓN INSTITUCIONAL POR USUARIO O CORREO
        // =========================================================================
        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nickname';
        $user = User::where($field, $loginInput)->first();

        // Si la contraseña coincide con el documento de la persona vinculada
        if ($user && $user->person && !$user->hasSuperAdmin() && (string)$user->person->document_number === $password) {
            $user->password = Hash::make($password);
            $user->save();
            Auth::login($user, $remember);
            $request->session()->regenerate();
            return $this->redirectByRole($user);
        }

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            $redirectUrl = $request->input('redirect');
            if (!empty($redirectUrl) && !str_contains($redirectUrl, '/login') && !str_contains($redirectUrl, 'egresados/welcome') && !str_ends_with($redirectUrl, '/egresados')) {
                return redirect()->to($redirectUrl);
            }

            return $this->redirectByRole($user);
        }

        return redirect()->back()
            ->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'])
            ->withInput($request->only('email'));
    }

    /**
     * Redirige al usuario al panel que le corresponde según su rol en Egresados.
     */
    public function redirectByRole(User $user)
    {
        // 1. Super Administrador General del ERP / Coordinación Académica -> Dashboard General
        if ($user->hasSuperAdmin() || 
            $user->nickname === 'superadmin_egresados' || 
            $user->email === 'superadmin.egresados@sena.edu.co' || 
            $user->nickname === 'superadmin' || 
            $user->nickname === 'admin' || 
            $user->roles->contains('slug', 'egresados.admin') || 
            $user->roles->contains('slug', 'superadmin')) {
            return redirect()->route('egresados.dashboard')
                ->with('success', '¡Bienvenido(a) al Panel de Control de Egresados, ' . $user->full_name . '!');
        }

        // 2. Instructor / Seguimiento -> Dashboard de Instructor de Egresados
        if ($user->nickname === 'instructor_egresados' || 
            $user->email === 'instructor.egresados@sena.edu.co' || 
            $user->roles->contains('slug', 'egresados.instructor') || 
            $user->roles->contains('slug', 'sigac.instructor') || 
            $user->roles->contains('slug', 'agrocefa.trainer')) {
            return redirect()->route('egresados.dashboard_instructor')
                ->with('success', '¡Bienvenido(a) al Panel de Seguimiento de Egresados, ' . $user->full_name . '!');
        }

        // 3. Egresado -> Portal del Egresado
        if ($user->roles->contains('slug', 'egresados.egresado') || 
            $user->roles->contains('slug', 'senaempresa.apprentice') || 
            $user->roles->contains('slug', 'sigac.apprentice') || 
            $user->nickname === 'egresado_sige' || 
            $user->email === 'egresado.sige@sena.edu.co') {
            return redirect()->route('egresados.dashboard_egresado')
                ->with('success', '¡Bienvenido(a) a tu Portal de Egresado, ' . $user->full_name . '!');
        }

        // Por defecto, redirigir al portal de egresados
        return redirect()->route('egresados.dashboard_egresado')
            ->with('info', 'Sesión iniciada como ' . $user->full_name);
    }

    /**
     * Cierra la sesión activa a través del logout del ERP.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $redirect = $request->input('redirect', $request->query('redirect', route('egresados.welcome')));
        return redirect()->to($redirect)->with('info', 'Has cerrado sesión correctamente.');
    }
}
