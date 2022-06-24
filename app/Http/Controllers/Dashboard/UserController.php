<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
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
    public function create()
    {
        $user = new User();
        $roles = Role::all()->pluck('name');
        return view('dashboard.users.create', compact(['user', 'roles']));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            'role' => 'required|exists:roles,name'
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();
        User::create($this->_fields($validated))->syncRoles($validated['role']);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
    public function _fields($resource)
    {
        return [
            'name' => $resource['name'],
            'email' => $resource['email'],
            'password' => Hash::make($resource['password'])
        ];
    }
}
