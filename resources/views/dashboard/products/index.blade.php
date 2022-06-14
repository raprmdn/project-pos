@extends('dashboard.layouts.app')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Products</h4>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Product</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="products-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Gambar</th>
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
            $('#products-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('products.table') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                    { data: 'barcode', name: 'barcode' },
                    { data: 'name', name: 'name' },
                    { data: 'stock', name: 'stock' },
                    { data: 'price', name: 'price' },
                    { data: 'category', name: 'category' },
                    { data: 'unit', name: 'unit' },
                    { data: 'product_picture', name: 'product_picture' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        $('#products-table').on('click', '.delete-item[data-url]', function () {
            let url = $(this).data('url');
            let name = $(this).data('name');

            Swal.fire({
                title: `Are you sure want delete "${name}"?`,
                text: "Product not deleted permanently! But you can restore it from trash.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: 'DELETE', _token:"{{ csrf_token() }}", submit: true}
                    }).always(function (data) {
                        if (data.status) {
                            Swal.fire({
                                title: data.message,
                                icon: 'success'
                            }).then(function () {
                                $('#products-table').DataTable().draw();
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
