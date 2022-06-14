@extends('dashboard.layouts.app')

@section('title', 'Permission: ' . $permission->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Permission</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <form action="{{ route('permissions.update', $permission) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $permission->id }}">
                    <div class="card-header">
                        <h5>Edit Permission : {{ $permission->name }}</h5>
                    </div>
                    @include('dashboard.role-permission.permissions.partials.form-control')
                </form>
            </div>
        </div>
    </div>
@endsection
