<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\App as SicaApp;

class PermisoController extends Controller
{
    /**
     * Catálogo institucional de permisos del ERP.
     */
    public function index(Request $request)
    {
        $query = Permission::with('app');

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where(function ($q) use ($buscar) {
                $q->where('name', 'like', "%{$buscar}%")
                  ->orWhere('slug', 'like', "%{$buscar}%")
                  ->orWhere('description', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('app_id')) {
            $query->where('app_id', $request->input('app_id'));
        }

        $permisos = $query->orderBy('name')->paginate(15);
        $totalPermisos = Permission::count();
        $apps = SicaApp::orderBy('name')->get();

        return view('admin::permisos.index', compact('permisos', 'totalPermisos', 'apps'));
    }
}
