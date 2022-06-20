<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.users.index');
    }

    public function userTableWithRoles()
    {
        $users = User::with('roles')->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('roles', function ($user) {
                return '<span class="badge badge-primary">' . $user->roles->pluck('name')->implode(', ') . '</span>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->diffForHumans();
            })
            ->rawColumns(['roles'])
            ->make();
    }

    public function userTable()
    {
        $users = User::latest();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                return '
                        <button class="btn btn-primary btn-xs select-user"
                                data-name="' . $user->name . '"
                                data-id="' . $user->id . '">
                            <i class="fas fa-check-circle"></i>
                            Select
                        </button>
                        ';
            })
            ->rawColumns(['action'])
            ->make();
    }
}
