@extends('dashboard.layouts.app')

@section('title', 'Units Trash')

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Categories Trash</li>
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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Categories Trash</h4>
        </div>
        <div class="card-body">
          <table class="table table-hover" id="units-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
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
    $(function() {
      $('#units-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ route('trash.categories.table') }}',
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
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ]
      });
    });

    $('#units-table').on('click', '.restore-item', function() {
      let url = $(this).data('url');
      let name = $(this).data('name');

      $.ajax({
        url: url,
        type: 'PUT',
        dataType: 'json',
        data: {
          method: 'PUT',
          _token: '{{ csrf_token() }}',
          submit: true,
        },
      }).always(function() {
        Swal.fire({
          title: 'Category " ' + name + ' " has been restored',
          icon: 'success',
        });
        $('#units-table').DataTable().ajax.reload();
      });
    });
  </script>
@endpush
