@extends('dashboard.layouts.app')

@section('title', 'Report')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Report</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('reports.index') }}" method="get">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Report {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</h4>
                            <div>
                                <div class="input-group">
                                    <a href="{{ route('reports.export-pdf', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]) }}" target="_blank" class="btn btn-primary mr-2">
                                        <i class="fas fa-file-pdf"></i>
                                        Export PDF
                                    </a>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control float-right"
                                           id="filter" name="filter">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="reports-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Pembelian Product</th>
                                <th>Penjualan Product</th>
                                <th>Pendapatan</th>
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
    <script src="{{ asset('dashboardpage/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $(function () {
            $('#reports-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: '{{ route('reports.table', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]) }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                    { data: 'date', name: 'date' },
                    { data: 'orders', name: 'orders' },
                    { data: 'sales', name: 'sales' },
                    { data: 'income', name: 'income' },
                ],
                paging: false,
                ordering: false,
                searching: false,
                info: false,
            });

            $('#filter').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: '{{ $startDate->format('Y-m-d') }}',
                endDate: '{{ $endDate->format('Y-m-d') }}'
            });
        });
    </script>
@endpush
