@extends('dashboard.layouts.app')

@section('title', 'Order: ' . $order->invoice)

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Order: {{ $order->invoice }}</li>
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
  <form id="order-form">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between mb-3">
              <div class="d-flex flex-column">
                <small class="text-muted">
                  Order Date
                </small>
                <h5 class="mb-3" id="order-date-preview-text">{{ $order->created_at->format('Y-m-d H:i:s') }}</h5>
                <small class="text-muted">
                  Supplier
                </small>
                <h5 class="mb-3" id="supplier-name-preview-text">{{ $order->supplier->name }}</h5>
              </div>
              <div class="d-flex flex-column text-right">
                <small class="text-muted">
                  Invoice
                </small>
                <h1 class="font-weight-bolder mb-3" id="invoice-preview-text">{{ $order->invoice }}</h1>
                <small class="text-muted">Total</small>
                <h1 class="font-weight-bolder mb-0" id="total-preview-text">Rp.
                  {{ \App\Helpers\Helper::rupiahFormat($order->total) }}</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body table-responsive">
            <table class="table DataTable table-hover" id="order-product-detail">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Barcode</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-center">
            <h5 class="mb-0 font-weight-bold">
              Order Summary
            </h5>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <label for="total-preview" class="col-sm-3 col-form-label">
                Total
              </label>
              <div class="col-sm-9">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Rp.
                    </span>
                  </div>
                  <input type="text" class="form-control" id="total-preview" name="total-preview" readonly
                    value="{{ \App\Helpers\Helper::rupiahFormat($order->total) }}" />
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="notes" class="col-sm-3 col-form-label">
                Notes
              </label>
              <div class="col-sm-9">
                <div class="input-group mb-3">
                  <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Notes">{{ $order->notes }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i>
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </form>
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
    $('#order-product-detail').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: '{{ route('order.detail.product.table', $order->uuid) }}',
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          searchable: false,
          orderable: false
        },
        {
          data: 'barcode',
          name: 'barcode'
        },
        {
          data: 'product',
          name: 'product'
        },
        {
          data: 'category',
          name: 'category'
        },
        {
          data: 'qty',
          name: 'qty'
        },
        {
          data: 'subtotal',
          name: 'subtotal'
        },
      ],
      paging: false,
      ordering: false,
      searching: false
    });
  </script>
@endpush
