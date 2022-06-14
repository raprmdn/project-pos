@extends('dashboard.layouts.app')

@section('title', 'Role ' . $role->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Role {{ $role->name }}</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="font-weight-bolder">{{ $role->name }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-1">List Permissions</div>
                    <div class="mb-3">
                        @foreach($role->permissions as $permission)
                            <div class="d-flex flex-row">
                                <span class="text-muted">- {{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Role {{ $role->name }}</h5>
                        <div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addUsers">Assign User Role</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover" id="user-role-list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUsers">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User to Role "{{ $role->name }}"</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-striped" id="user-list" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('dashboardpage/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#user-list').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.table') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        $(document).ready(function() {
            $('#user-role-list').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.by.role', [$role->id]) }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        $('#user-role-list').on('click', '.delete-item', function () {
            let url = `{!! route('roles.user.revoke', $role->id) !!}`;
            let name = $(this).data('name');
            let userId = $(this).data('id');

            Swal.fire({
                title: `Are you sure want revole role "${name}"?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, revoke!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: 'DELETE', _token:"{{ csrf_token() }}", submit: true, user_id: userId}
                    }).always(function (data) {
                        if (data.status) {
                            Swal.fire({
                                title: data.message,
                                icon: 'success'
                            }).then(function () {
                                $('#user-role-list').DataTable().draw();
                            });
                        }
                    });
                }
            });
        });

        $('#user-list').on('click', '.select-user', function () {
            let url = `{!! route('assign-role', $role->id) !!}`;
            let userId = $(this).data('id');

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {method: 'POST', _token:"{{ csrf_token() }}", submit: true, user_id: userId}
            }).always(function (data) {
                $('#addUsers').modal('hide');
                if (data.status) {
                    Swal.fire({
                        title: data.message,
                        icon: 'success'
                    }).then(function () {
                        $('#user-role-list').DataTable().draw();
                    });
                }
                console.log(data)
            });
        });
    </script>
@endpush
