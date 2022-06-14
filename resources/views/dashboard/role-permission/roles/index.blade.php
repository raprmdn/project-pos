@extends('dashboard.layouts.app')

@section('title', 'Roles')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-ban"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-3 mb-7">
            <div class="card shadow-lg">
                <div class="card-body d-flex justify-content-center">
                    <button class="btn d-flex flex-column flex-center" data-toggle="modal" data-target="#addRoleModal">
                        <img src="{{ asset('dashboardpage/dist/img/user-role.png') }}" alt="add-role"
                             class="mw-100 mh-150px mb-7">
                        <h3 class="font-weight-bolder text-dark">Add New Role</h3>
                    </button>
                </div>
            </div>
        </div>
        @foreach($roles as $role)
            <div class="col-lg-3 mb-7">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="font-weight-bolder">{{ $role->name }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">Total user with this role : {{ $role->users_count }}</div>
                        <div class="mb-3">
                            @foreach($role->permissions->take(7) as $permission)
                                <div class="d-flex flex-row">
                                    <span class="text-muted">- {{ $permission->name }}</span>
                                </div>
                            @endforeach
                            @if(count($role->permissions) > 7)
                                <div class="d-flex flex-row">
                                    <span class="text-muted">- and {{ $role->permissions_count - 7 }} more...</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row justify-content-end">
                            <a href="{{ route('roles.show', $role) }}" class="btn btn-info mr-2">View</a>
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary mr-2">Edit</a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-role" data-name="{{ $role->name }}">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="addRoleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('roles.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror"
                                   id="role_name" name="role_name" value="{{ old('role_name') }}" placeholder="Enter Role Name">
                            @error('role_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guard_name" title="Default: web">Guard Name</label>
                            <input type="text" class="form-control @error('guard_name') is-invalid @enderror"
                                   id="guard_name" name="guard_name" value="{{ old('guard_name') ?? 'web' }}" placeholder="Enter Guard Name">
                            @error('guard_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="permissions">Permissions</label>
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="{{ $permission->name }}"
                                           name="permissions[]" value="{{ $permission->id }}">
                                    <label class="form-check-label"
                                           for="{{ $permission->name }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboardpage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    @if($errors->any())
        <script>
            $(document).ready(function () {
                $('#addRoleModal').modal('show');
            });
        </script>
    @endif

    <script>
        $(document).ready(function () {
            $('.delete-role').on('click', function (e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let name = $(this).data('name');

                Swal.fire({
                    title: `Are you sure want delete "${name}"?`,
                    text: "Delete the roles, you might break the system roles functionality. Please ensure you're absolutely certain before proceeding.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
