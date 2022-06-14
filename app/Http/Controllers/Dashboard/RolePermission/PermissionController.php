<?php

namespace App\Http\Controllers\Dashboard\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = new Permission();

        return view('dashboard.role-permission.permissions.index', compact('permission'));
    }

    public function table()
    {
        $permissions = Permission::latest();

        return DataTables::of($permissions)
            ->addIndexColumn()
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at->format('d F Y, H:i');
            })
            ->addColumn('action', function ($permission) {
                $urlEdit = route('permissions.edit', $permission->id);
                $urlDelete = route('permissions.destroy', $permission->id);
                return '
                        <div class="row">
                            <a href="' . $urlEdit . '" class="btn btn-primary btn-xs mr-2" title="Edit permission">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-xs delete-item"
                                    data-url="' . $urlDelete . '"
                                    data-name="' . $permission->name . '">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        ';
            })
            ->rawColumns(['action', 'created_at'])
            ->make();
    }

    public function store(PermissionRequest $request)
    {
        Permission::create([
            'name' => $request->permission_name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->back()->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.role-permission.permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->permission_name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        if ($permission->roles()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Permission is assigned to a role. Cannot delete this permission.',
            ]);
        }
        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission deleted successfully.',
        ]);
    }
}
