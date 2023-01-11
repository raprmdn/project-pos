@extends('dashboard.layouts.app')

@section('title', 'Transaction : ' . $sale->invoice)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaction {{ $sale->invoice }}</li>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between mb-3">
                        <div class="d-flex flex-column">
                            <small class="text-muted">Transaction Date</small>
                            <h5 class="mb-3">{{ $sale->created_at->format('d F Y, H:i') }}</h5>
                            <small class="text-muted">Cashier</small>
                            <h5 class="mb-3">{{ $sale->user->name }}</h5>
                            <small class="text-muted">Customer</small>
                            <h5 class="mb-0">Umum</h5>
                        </div>
                        <div class="d-flex flex-column text-right">
                            <small class="text-muted">Invoice</small>
                            <h1 class="font-weight-bolder mb-3">{{ $sale->invoice }}</h1>
                            <small class="text-muted">Total</small>
                            <h1 class="font-weight-bolder mb-0">
                                Rp. {{ \App\Helpers\Helper::rupiahFormat($sale->total) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover" id="sale-product-detail">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
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
                    <h5 class="mb-0 font-weight-bold">Transaction Summary</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="subtotal-preview" class="col-sm-3 col-form-label">Subtotal</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="subtotal-preview"
                                       value="Rp. {{ \App\Helpers\Helper::rupiahFormat($sale->subtotal) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="col-sm-3 col-form-label">Discount</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="discount" value="{{ $sale->discount }}%"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="saved-preview" class="col-sm-3 col-form-label">Hemat</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="saved-preview"
                                       value="Rp. {{ \App\Helpers\Helper::rupiahFormat($sale->saved) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total-preview" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="total-preview"
                                       value="Rp. {{ \App\Helpers\Helper::rupiahFormat($sale->total) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="received" class="col-sm-3 col-form-label">Tunai</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="received"
                                       value="Rp. {{ \App\Helpers\Helper::rupiahFormat($sale->received) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="change" id="change-label" class="col-sm-3 col-form-label">Kembalian</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="change"
                                       value="Rp. {{ \App\Helpers\Helper::rupiahFormat($sale->change) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                        <div class="col-sm-9">
                            <div class="input-group mb-3">
                <textarea class="form-control" id="notes" rows="3" style="white-space: normal" readonly>
                                    {{ $sale->notes }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" id="print">
                        <i class="fas fa-print"></i>
                        Print Invoice
                    </button>
                    <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
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

    <script>
        let format = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        })
        $('#sale-product-detail').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('transactions.sale-detail', $sale->uuid) }}',
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
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'unit_price',
                    name: 'unit_price'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'total',
                    name: 'total'
                },
            ],
            paging: false,
            ordering: false,
            searching: false
        });
        $("#print").click(function () {
            function formatNum(num) {
                let reverse = num.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }

            $.ajax({
                url: '{{ route('sales.detail.invoice', $sale->uuid) }}',
                type: 'GET',
                dataType: 'json'
            }).always((data) => {
                console.log(data);
                let contents = `
        <div style="width:60mm">
                  <div class="row">
                      <div>
                          <p class="text-center">${data.user.name}</p>
                      </div>
                      <hr/>
                      <div>
                          <p>Invoice: ${data.invoice}</p>
                          <p>Date: ${new Date(data.created_at)}</p>
                      </div>
                      <hr/>
                      <div>
                          <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                              ${data.sale_details.map((sale_detail) => {
                    return `
                                      <tr>
                                          <td>
                                              <p style="margin:0">${sale_detail.product.name}</p>
                                              <p style="margin:0">${sale_detail.qty} @${formatNum(sale_detail.unit_price)}</p>
                                          </td>
                                          <td style="text-align:right">${format.format(sale_detail.total)}</td>
                                      </tr>`;
                }).join('')}
                              </tbody>
                          </table>
                      </div>
                      <hr/>
                      <div>
                        <div style="display:flex;justify-content:space-between;margin:0">
                            <p style="margin:0"><b>Total</b></p>
                            <p style="margin:0"><b>${format.format(data.total)}</b></p>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin:0">
                            <p style="margin:0"><b>Terima</b></p>
                            <p style="margin:0"><b>${format.format(data.received)}</b></p>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin:0">
                            <p style="margin:0"><b>Kembali</b></p>
                            <p style="margin:0"><b>${format.format(data.change)}</b></p>
                        </div>
                      </div>
                  </div>
              </div>
      `;
                let frame1 = document.createElement("iframe");
                frame1.name = "frame1";
                frame1.style.position = "absolute";
                frame1.style.top = "-1000000px";
                document.body.appendChild(frame1);
                let frameDoc = frame1.contentWindow ?
                    frame1.contentWindow :
                    frame1.contentDocument.document ?
                        frame1.contentDocument.document :
                        frame1.contentDocument;
                frameDoc.document.open();

                frameDoc.document.write(contents);
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    document.body.removeChild(frame1);
                }, 500);
                return false;
            });
        })
    </script>
@endpush
