@extends('dashboard.layouts.app')

@section('title', 'Role : ' . $role->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Role</li>
@endsection

@section('content')
    <div class="callout callout-danger">
        <h5>Attention!</h5>
        <p>Editing the role, you might break the system roles functionality. Please ensure you're absolutely certain before proceeding.</p>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Edit Role : {{ $role->name }}</h4>
                    </div>
                </div>
                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror" id="role_name" name="role_name" value="{{ $role->name }}">
                            @error('role_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="guard_name">Guard Name</label>
                            <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" value="{{ $role->guard_name }}">
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
                                           name="permissions[]" value="{{ $permission->id }}"
                                           @if($role->permissions->contains($permission)) checked @endif>
                                    <label class="form-check-label"
                                           for="{{ $permission->name }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
