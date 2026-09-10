<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\App as SicaApp;
use Modules\Admin\Entities\Audit;

class AdminController extends Controller
{
    /**
     * Página de Bienvenida / Landing Institucional del Módulo de Administración.
     */
    public function welcome()
    {
        $totalUsuarios = User::count();
        $totalRoles = Role::count();
        $totalPermisos = Permission::count();
        $totalAuditorias = Audit::count();

        // Submódulos destacados
        $rolesDestacados = Role::withCount('users')->orderBy('users_count', 'desc')->take(4)->get();
        $ultimosUsuarios = User::with(['person', 'roles'])->orderBy('created_at', 'desc')->take(4)->get();

        return view('admin::welcome', compact(
            'totalUsuarios',
            'totalRoles',
            'totalPermisos',
            'totalAuditorias',
            'rolesDestacados',
            'ultimosUsuarios'
        ));
    }

    /**
     * Tablero de Control / Dashboard de Administración.
     */
    public function dashboard()
    {
        $totalUsuarios = User::count();
        $totalRoles = Role::count();
        $totalPermisos = Permission::count();
        $totalAuditorias = Audit::count();

        // Métricas de auditoría por tipo de evento
        $auditoriasPorEvento = [
            'created' => Audit::where('event', 'created')->count(),
            'updated' => Audit::where('event', 'updated')->count(),
            'deleted' => Audit::where('event', 'deleted')->count(),
        ];

        // Distribución de usuarios por rol principal
        $rolesPopulares = Role::withCount('users')->orderBy('users_count', 'desc')->take(5)->get();

        // Últimas actividades y usuarios
        $ultimosUsuarios = User::with(['person', 'roles'])->orderBy('created_at', 'desc')->take(5)->get();
        $ultimasAuditorias = Audit::with('user.person')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin::dashboard', compact(
            'totalUsuarios',
            'totalRoles',
            'totalPermisos',
            'totalAuditorias',
            'auditoriasPorEvento',
            'rolesPopulares',
            'ultimosUsuarios',
            'ultimasAuditorias'
        ));
    }
}
