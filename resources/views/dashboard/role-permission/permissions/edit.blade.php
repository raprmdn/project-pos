@extends('dashboard.layouts.app')

@section('title', 'Permission: ' . $permission->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Permission</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
    <div class="callout callout-danger">
        <h5>Attention!</h5>
        <p>Editing the permissions, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.</p>
    </div>
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

@push('scripts')
    <script src="{{ asset('dashboardpage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.update').click(function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "Warning! You are about to edit the permission, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, continue!",
                }).then((isConfirmed) => {
                    console.log(isConfirmed);
                    if (isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
