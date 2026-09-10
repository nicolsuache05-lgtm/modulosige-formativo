<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Listado general de usuarios con filtros y métricas.
     */
    public function index(Request $request)
    {
        $query = User::with(['person', 'roles']);

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where(function ($q) use ($buscar) {
                $q->where('name', 'like', "%{$buscar}%")
                  ->orWhere('email', 'like', "%{$buscar}%")
                  ->orWhere('nickname', 'like', "%{$buscar}%")
                  ->orWhereHas('person', function ($pQuery) use ($buscar) {
                      $pQuery->where('first_name', 'like', "%{$buscar}%")
                             ->orWhere('first_last_name', 'like', "%{$buscar}%")
                             ->orWhere('second_last_name', 'like', "%{$buscar}%")
                             ->orWhere('document_number', 'like', "%{$buscar}%");
                  });
            });
        }

        if ($request->filled('role_id')) {
            $roleId = $request->input('role_id');
            $query->whereHas('roles', function ($rQuery) use ($roleId) {
                $rQuery->where('roles.id', $roleId);
            });
        }

        $usuarios = $query->orderBy('created_at', 'desc')->paginate(12);

        $totalUsuarios = User::count();
        $totalRoles = Role::count();
        $rolesDisponibles = Role::orderBy('name')->get();

        return view('admin::usuarios.index', compact('usuarios', 'totalUsuarios', 'totalRoles', 'rolesDisponibles'));
    }

    /**
     * Formulario de creación de usuario.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        $personas = Person::orderBy('first_name')->take(50)->get();

        return view('admin::usuarios.create', compact('roles', 'personas'));
    }

    /**
     * Almacenar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50|unique:users,nickname',
            'email' => 'required|email|max:190|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'person_id' => 'nullable|exists:people,id',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'nickname' => $validated['nickname'],
            'name' => $validated['nickname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'person_id' => $validated['person_id'] ?? null,
        ]);

        if (!empty($validated['roles'])) {
            $user->roles()->sync($validated['roles']);
        }

        return redirect()->route('admin.usuarios.index')->with('success', '¡Usuario creado exitosamente con sus roles asignados!');
    }

    /**
     * Formulario de edición de usuario.
     */
    public function edit($id)
    {
        $usuario = User::with(['person', 'roles'])->findOrFail($id);
        $roles = Role::orderBy('name')->get();
        $personas = Person::orderBy('first_name')->take(50)->get();

        return view('admin::usuarios.edit', compact('usuario', 'roles', 'personas'));
    }

    /**
     * Actualizar información y roles de un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nickname' => 'required|string|max:50|unique:users,nickname,' . $user->id,
            'email' => 'required|email|max:190|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'person_id' => 'nullable|exists:people,id',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
        ]);

        $updateData = [
            'nickname' => $validated['nickname'],
            'name' => $validated['nickname'],
            'email' => $validated['email'],
            'person_id' => $validated['person_id'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        if (isset($validated['roles'])) {
            $user->roles()->sync($validated['roles']);
        }

        return redirect()->route('admin.usuarios.index')->with('success', '¡Usuario actualizado correctamente!');
    }

    /**
     * Eliminar usuario (SoftDelete).
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.usuarios.index')->with('success', '¡Usuario eliminado del sistema correctamente!');
    }
}
