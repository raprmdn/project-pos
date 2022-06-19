@extends('dashboard.layouts.app')
@php
$i = 1;
@endphp
@section('title')
  Supplier
@endsection
@section('styles')
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h2 class="">Daftar Supplier</h2>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Tambah Supplier</a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover table-bordered" id="categories-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Description</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script src="{{ asset('dashboardpage/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
      $(function() {
        $('#categories-table').DataTable({
          responsive: true,
          processing: true,
          serverSide: true,
          ajax: '{{ route('suppliers.table') }}',
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex',
              searchable: false,
              orderable: false
            },
            {
              data: 'name',
              name: 'name'
            },
            {
              data: 'address',
              name: 'address'
            },
            {
              data: 'phone',
              name: 'phone'
            },
            {
              data: 'description',
              name: 'description'
            },
            {
              data: 'action',
              name: 'action',
              orderable: false,
              searchable: false
            }
          ]
        });
      });

      $('#categories-table').on('click', '.delete-item[data-url]', function() {
        let url = $(this).data('url');
        let name = $(this).data('name');

        Swal.fire({
          title: `Are you sure want delete "${name}"?`,
          text: "Category not deleted permanently! But you can restore it from trash.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: url,
              type: 'DELETE',
              dataType: 'json',
              data: {
                method: 'DELETE',
                _token: "{{ csrf_token() }}",
                submit: true
              }
            }).always(function(data) {
              if (data.status) {
                Swal.fire({
                  title: data.message,
                  icon: 'success'
                }).then(function() {
                  $('#categories-table').DataTable().draw();
                });
              } else {
                Swal.fire({
                  title: data.message,
                  icon: 'error'
                });
              }
            });
          }
        });
      });
    </script>
  @endpush
@endsection
