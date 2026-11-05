<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión del ERP.
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $redirect = $request->query('redirect', '');
            if (!empty($redirect) && !str_contains($redirect, 'login') && !str_contains($redirect, 'egresados/welcome') && !str_ends_with($redirect, '/egresados')) {
                return redirect($redirect);
            }

            // Redirección directa al panel correspondiente según el usuario autenticado
            if ($user->hasSuperAdmin() || $user->nickname === 'superadmin_egresados' || $user->email === 'superadmin.egresados@sena.edu.co' || $user->nickname === 'superadmin' || ($user->roles && ($user->roles->contains('slug', 'egresados.admin') || $user->roles->contains('slug', 'superadmin')))) {
                return redirect()->route('egresados.dashboard');
            }

            if ($user->nickname === 'instructor_egresados' || $user->email === 'instructor.egresados@sena.edu.co' || ($user->roles && ($user->roles->contains('slug', 'egresados.instructor') || $user->roles->contains('slug', 'sigac.instructor')))) {
                return redirect()->route('egresados.dashboard_instructor');
            }

            if ($user->nickname === 'egresado_sige' || $user->email === 'egresado.sige@sena.edu.co' || ($user->roles && $user->roles->contains('slug', 'egresados.egresado'))) {
                return redirect()->route('egresados.dashboard_egresado');
            }

            return redirect()->route('direccion.welcome')->with('info', 'Ya has iniciado sesión como ' . $user->full_name);
        }

        $redirect = $request->query('redirect', '');
        return view('login', compact('redirect'));
    }

    /**
     * Procesa la autenticación del usuario en el ERP.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Debes ingresar tu correo institucional o usuario.',
            'password.required' => 'Debes ingresar tu contraseña.',
        ]);

        $loginInput = trim($request->input('email'));
        $password = trim($request->input('password'));
        $remember = $request->boolean('remember');

        // =========================================================================
        // A. ACCESO DIRECTO PARA EGRESADOS CON NÚMERO DE CÉDULA
        // Permite que cualquier egresado/aprendiz registrado en el sistema ingrese
        // usando su cédula como usuario y también como contraseña.
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
                // Verificar si la contraseña ingresada coincide con el documento de identidad
                $isDocPassword = ($password === (string)$person->document_number || $password === $cleanDoc || $password === $loginInput);

                // Buscar si la persona ya cuenta con un usuario en el ERP
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
                    // Si no existe el usuario, se crea dinámicamente con las credenciales institucionales
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

                    // Actualizar contraseña a la cédula para sincronización
                    $user->password = Hash::make($cleanDoc);
                    $user->person_id = $person->id;
                    $user->save();

                    // Garantizar asignación del rol de egresado
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
                        // Resiliente ante restricciones de entorno
                    }

                    Auth::login($user, $remember);
                    $request->session()->regenerate();

                    return redirect()->route('egresados.dashboard_egresado')
                        ->with('success', '¡Bienvenido(a) a tu Portal de Egresados, ' . ($user->full_name ?: $person->full_name) . '!');
                }
            }
        }

        // =========================================================================
        // B. AUTENTICACIÓN CONVENCIONAL DEL ERP
        // =========================================================================
        // Buscar al usuario por correo o por nickname
        $user = User::where('email', $loginInput)
            ->orWhere('nickname', $loginInput)
            ->first();

        // Si el usuario existe y su contraseña coincide con el documento de su persona vinculada
        if ($user && $user->person && !$user->hasSuperAdmin() && (string)$user->person->document_number === $password) {
            $user->password = Hash::make($password);
            $user->save();
            Auth::login($user, $remember);
            $request->session()->regenerate();
            return redirect()->route('egresados.dashboard_egresado')
                ->with('success', '¡Bienvenido(a) a tu Portal de Egresados, ' . $user->full_name . '!');
        }

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            // Identificar perfil del usuario
            $isSuperAdmin = $user->hasSuperAdmin() || 
                            $user->nickname === 'superadmin_egresados' || 
                            $user->email === 'superadmin.egresados@sena.edu.co' || 
                            $user->nickname === 'superadmin' || 
                            $user->nickname === 'admin' || 
                            ($user->roles && ($user->roles->contains('slug', 'egresados.admin') || $user->roles->contains('slug', 'superadmin')));

            $isInstructor = $user->nickname === 'instructor_egresados' || 
                            $user->email === 'instructor.egresados@sena.edu.co' || 
                            ($user->roles && (
                                $user->roles->contains('slug', 'egresados.instructor') || 
                                $user->roles->contains('slug', 'sigac.instructor') || 
                                $user->roles->contains('slug', 'agrocefa.trainer')
                            ));

            $isEgresado = $user->nickname === 'egresado_sige' || 
                          $user->email === 'egresado.sige@sena.edu.co' || 
                          str_contains(strtolower($user->nickname ?? ''), 'egresad') ||
                          str_contains(strtolower($user->email ?? ''), 'egresad') ||
                          ($user->roles && (
                              $user->roles->contains('slug', 'egresados.egresado') ||
                              $user->roles->contains('slug', 'senaempresa.apprentice') ||
                              $user->roles->contains('slug', 'sigac.apprentice') ||
                              $user->roles->contains(fn($r) => str_contains($r->slug, 'egresad')) ||
                              $user->roles->contains(fn($r) => str_contains($r->slug, 'apprentice'))
                          )) ||
                          ($user->person_id && (
                              \Modules\SICA\Entities\Apprentice::where('person_id', $user->person_id)->exists() ||
                              (class_exists('\Modules\Egresados\Entities\Apprentice') && \Modules\Egresados\Entities\Apprentice::where('person_id', $user->person_id)->exists())
                          ));

            $redirectUrl = $request->input('redirect');
            $isGenericRedirect = empty($redirectUrl) || 
                                 str_contains($redirectUrl, 'egresados/welcome') || 
                                 str_contains($redirectUrl, 'egresados/home') || 
                                 str_ends_with($redirectUrl, '/egresados') || 
                                 str_contains($redirectUrl, 'egresados/login') ||
                                 str_contains($redirectUrl, 'dashboard-egresado') ||
                                 str_contains($redirectUrl, 'direccion/welcome');

            // 1. SuperAdmin -> Directo a su Dashboard de SuperAdmin
            if ($isSuperAdmin) {
                if (!$isGenericRedirect && str_contains($redirectUrl, 'superadmin')) {
                    return redirect($redirectUrl);
                }
                return redirect()->route('egresados.dashboard');
            }

            // 2. Admin / Instructor -> Directo a su Dashboard de Instructor
            if ($isInstructor) {
                if (!$isGenericRedirect && str_contains($redirectUrl, 'instructor')) {
                    return redirect($redirectUrl);
                }
                return redirect()->route('egresados.dashboard_instructor');
            }

            // 3. Egresado -> Directo a su Dashboard de Egresado
            if ($isEgresado) {
                if (!$isGenericRedirect && (str_contains($redirectUrl, 'egresados/encuestas') || str_contains($redirectUrl, 'egresados/oportunidades'))) {
                    return redirect($redirectUrl);
                }
                return redirect()->route('egresados.dashboard_egresado');
            }

            // Fallback por defecto si tiene otra ruta válida
            if (!empty($redirectUrl) && (str_starts_with($redirectUrl, '/') || str_starts_with($redirectUrl, url('/')))) {
                return redirect($redirectUrl);
            }

            return redirect()->intended(route('direccion.welcome'));
        }

        return back()
            ->withInput($request->only('email', 'remember', 'redirect'))
            ->withErrors([
                'email' => 'Las credenciales ingresadas no coinciden con nuestros registros.',
            ]);
    }

    /**
     * Cierra la sesión activa del usuario.
     */
    public function logout(Request $request)
    {
        $userName = Auth::check() ? Auth::user()->full_name : 'Usuario';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $redirectUrl = $request->input('redirect', $request->query('redirect', ''));
        if (!empty($redirectUrl) && (str_starts_with($redirectUrl, '/') || str_starts_with($redirectUrl, url('/')))) {
            return redirect($redirectUrl)->with('info', 'Has cerrado sesión exitosamente.');
        }

        return redirect()->route('direccion.welcome')->with('info', 'Has cerrado sesión exitosamente. ¡Hasta pronto, ' . $userName . '!');
    }
}
