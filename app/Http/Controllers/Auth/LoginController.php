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
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        // Buscar al usuario por correo o por nickname
        $user = User::where('email', $loginInput)
            ->orWhere('nickname', $loginInput)
            ->first();

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
                          (class_exists('\Modules\Egresados\Entities\Apprentice') && \Modules\Egresados\Entities\Apprentice::where('person_id', $user->person_id)->exists());

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
