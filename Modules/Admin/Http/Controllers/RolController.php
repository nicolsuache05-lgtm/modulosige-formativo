<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\App as SicaApp;
use Illuminate\Support\Str;

class RolController extends Controller
{
    /**
     * Listado de roles con número de usuarios y permisos asignados.
     */
    public function index(Request $request)
    {
        $query = Role::with(['app', 'permissions'])->withCount('users');

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

        $roles = $query->orderBy('name')->paginate(12);

        $totalRoles = Role::count();
        $totalPermisos = Permission::count();
        $apps = SicaApp::orderBy('name')->get();

        return view('admin::roles.index', compact('roles', 'totalRoles', 'totalPermisos', 'apps'));
    }

    /**
     * Formulario de creación de rol.
     */
    public function create()
    {
        $apps = SicaApp::orderBy('name')->get();
        $permisos = Permission::with('app')->orderBy('name')->get();

        return view('admin::roles.create', compact('apps', 'permisos'));
    }

    /**
     * Almacenar un nuevo rol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'slug' => 'required|string|max:50|unique:roles,slug',
            'description' => 'nullable|string|max:255',
            'full_access' => 'required|in:No,Si',
            'app_id' => 'required|exists:apps,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'description' => $validated['description'] ?? '',
            'full_access' => $validated['full_access'],
            'app_id' => $validated['app_id'],
        ]);

        if (!empty($validated['permissions'])) {
            $role->permissions()->sync($validated['permissions']);
        }

        return redirect()->route('admin.roles.index')->with('success', '¡Rol registrado exitosamente con sus privilegios!');
    }

    /**
     * Formulario de edición de rol.
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $apps = SicaApp::orderBy('name')->get();
        $permisos = Permission::with('app')->orderBy('name')->get();

        return view('admin::roles.edit', compact('role', 'apps', 'permisos'));
    }

    /**
     * Actualizar rol y permisos asignados.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
            'slug' => 'required|string|max:50|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string|max:255',
            'full_access' => 'required|in:No,Si',
            'app_id' => 'required|exists:apps,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'description' => $validated['description'] ?? '',
            'full_access' => $validated['full_access'],
            'app_id' => $validated['app_id'],
        ]);

        $role->permissions()->sync($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success', '¡Rol y permisos actualizados correctamente!');
    }

    /**
     * Eliminar rol del sistema.
     */
    public function destroy($id)
    {
        $role = Role::withCount('users')->findOrFail($id);

        if ($role->users_count > 0) {
            return redirect()->route('admin.roles.index')->with('error', 'No se puede eliminar el rol porque tiene usuarios asociados.');
        }

        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', '¡Rol eliminado con éxito!');
    }
}
