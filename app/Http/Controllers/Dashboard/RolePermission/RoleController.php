<?php

namespace App\Http\Controllers\Dashboard\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->get(['id', 'name']);
        $roles = Role::with('permissions')->withCount(['users', 'permissions'])->latest()->get(['id', 'name']);

        return view('dashboard.role-permission.roles.index', compact(['roles', 'permissions']));
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        $users = User::latest()->get();

        return view('dashboard.role-permission.roles.show', compact(['role', 'users']));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->role_name,
            'guard_name' => $request->guard_name,
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::latest()->get(['id', 'name']);
        $role = Role::with('permissions')->findOrFail($role->id);

        return view('dashboard.role-permission.roles.edit', compact(['role', 'permissions']));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->role_name,
            'guard_name' => $request->guard_name,
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')->with('error', 'Role has users. Cannot delete the roles.');
        }
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function assignRole(Role $role)
    {
        $user = User::findOrFail(request('user_id'));
        $user->syncRoles($role->id);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }

    public function revokeRole(Role $role)
    {
        $user = User::findOrFail(request('user_id'));
        $user->removeRole($role->id);

        return response()->json([
            'status' => true,
            'message' => 'Role revoked successfully.',
        ]);
    }
}
