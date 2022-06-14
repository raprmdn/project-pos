<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function getUserByRole(Role $role)
    {
        $users = User::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->get(['id', 'name', 'email']);

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '
                        <button class="btn btn-danger btn-xs delete-item"
                                data-name="' . $user->name . '"
                                data-id="' . $user->id . '">
                            Revoke
                        </button>
                        ';
            })
            ->rawColumns(['action'])
            ->make();
    }
}
