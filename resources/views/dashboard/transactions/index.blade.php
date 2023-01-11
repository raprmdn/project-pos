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
    <link rel="stylesheet"
          href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
    <form id="sale-form">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between mb-3">
                            <div class="d-flex flex-column">
                                <small class="text-muted">Transaction Date</small>
                                <h5 class="mb-3" id="transaction-date-preview-text"></h5>
                                <small class="text-muted">Cashier</small>
                                <h5 class="mb-3" id="cashier-name-preview-text"></h5>
                                <small class="text-muted">Customer</small>
                                <h5 class="mb-0">Umum</h5>
                            </div>
                            <div class="d-flex flex-column text-right">
                                <small class="text-muted">Invoice</small>
                                <h1 class="font-weight-bolder mb-3" id="invoice-preview-text"></h1>
                                <small class="text-muted">Total</small>
                                <h1 class="font-weight-bolder mb-0" id="total-preview-text"></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly placeholder="Select product">
                            <span class="input-group-append">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#select-product">
                  <i class="fas fa-search"></i>
                </button>
              </span>
                        </div>
                    </div>
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
                                <th>Action</th>
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
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="subtotal-preview"
                                           name="subtotal-preview" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-sm-3 col-form-label">Discount</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="discount" name="discount">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                        <button type="button" class="btn btn-success" id="apply-discount">
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="saved-preview" class="col-sm-3 col-form-label">Hemat</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="saved-preview" name="saved-preview"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total-preview" class="col-sm-3 col-form-label">Total</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="total-preview" name="total-preview"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="received" class="col-sm-3 col-form-label">Tunai</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="received" name="received">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success" id="apply-cash">
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="change" id="change-label" class="col-sm-3 col-form-label">Kembalian</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" id="change" name="change" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="notes" class="col-sm-3 col-form-label">Notes</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                              placeholder="Notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary" id="save-transaction" disabled>
                            <i class="fas fa-save"></i>
                            Save Transaction
                        </button>
                        <button type="button" class="btn btn-warning" id="reset-transaction">
                            <i class="fas fa-redo-alt"></i>
                            Reset
                        </button>
                        <button type="button" id="cancel-transaction" class="btn btn-danger">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('dashboard.transactions.product')
    @include('dashboard.transactions.edit-product-modal')
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
    <script src="{{ asset('dashboardpage/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
        let format = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        })
        $('#products-list').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('select.products') }}',
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

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
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            paging: false,
            ordering: false,
            searching: false
        });

        $('#products-list').on('click', '.selected-product', function () {
            let id = $(this).data('id');
            let url = `{{ route('api.transactions.add-product', $sale->uuid) }}`

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    product_id: id,
                },
                dataType: 'json',
            }).always(function (data) {
                $('#select-product').modal('hide');
                if (data.status !== 200) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                }
                getSaleDetail();
                $('#products-list').DataTable().ajax.reload();
                $('#sale-product-detail').DataTable().ajax.reload();
                console.log(data.message);
            });
        });

        $('#sale-product-detail').on('click', '#edit-sale-detail-button', function () {
            $('#edit-product-sale-detail').modal('show');
            let saleDetailId = $(this).data('sale-detail-id');
            let saleDetailQty = $(this).data('sale-detail-qty');
            let productId = $(this).data('product-id');
            let productName = $(this).data('product-name');
            let productStock = $(this).data('product-stock');

            $('#modal-edit-sale-detail-title').text(`Edit qty ${productName}`);
            $('#update-form #product_name').val(productName);
            $('#update-form #sale-detail-id').val(saleDetailId);
            $('#update-form #product-id').val(productId);
            $('#update-form #qty').val(saleDetailQty);
            $('#update-form #info-stock-product').text(`Product stock is ${productStock} left.`);
            $('#update-form #qty').inputmask("numeric", {
                alias: "numeric",
                min: 1,
                max: productStock + saleDetailQty,
                allowMinus: false,
                allowZero: false,
                rightAlign: false,
            });
        });

        $('#update-form').on('submit', function (e) {
            e.preventDefault();
            let url = '{{ route('api.transactions.update-product', $sale->uuid) }}';
            let qty = $('#update-form #qty').val();
            let saleDetailId = $('#update-form #sale-detail-id').val();
            let productId = $('#update-form #product-id').val();

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                data: {
                    sale_detail_id: saleDetailId,
                    product_id: productId,
                    qty: qty,
                }
            }).always(function (data) {
                $('#edit-product-sale-detail').modal('hide');
                if (data.status !== 200) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                }
                getSaleDetail();
                $('#sale-product-detail').DataTable().ajax.reload();
                $('#products-list').DataTable().ajax.reload();
                console.log(data.message);
            });
        });

        $('#sale-product-detail').on('click', '#delete-sale-detail-button', function () {
            let saleDetailId = $(this).data('sale-detail-id');
            let productId = $(this).data('product-id');
            let productName = $(this).data('product-name');
            let url = '{{ route('api.transactions.delete-product', $sale->uuid) }}';

            Swal.fire({
                title: 'Are you sure?',
                text: `You want to delete "${productName}" product?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            sale_detail_id: saleDetailId,
                            product_id: productId,
                        }
                    }).always(function (data) {
                        if (data.status !== 200) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: data.message,
                                confirmButtonText: 'Ok'
                            });
                        }
                        getSaleDetail();
                        $('#sale-product-detail').DataTable().ajax.reload();
                        $('#products-list').DataTable().ajax.reload();
                        console.log(data.message);
                    });
                }
            });
        });

        $('#apply-discount').on('click', function () {
            let discount = $('#discount').val();
            let url = '{{ route('api.transactions.apply-discount', $sale->uuid) }}';

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                data: {
                    discount: discount,
                }
            }).always(function (data) {
                if (data.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                    console.log(data.message);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                }
                getSaleDetail();
                $('#sale-product-detail').DataTable().ajax.reload();
                $('#products-list').DataTable().ajax.reload();
                console.log(data.message);
            });
        });

        $('#apply-cash').on('click', function () {
            let cash = $('#received').val();
            let url = '{{ route('api.transactions.apply-cash', $sale->uuid) }}';

            $.ajax({
                url: url,
                type: 'PUT',
                dataType: 'json',
                data: {
                    cash: cash,
                }
            }).always(function (data) {
                if (data.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                }
                getSaleDetail();
                $('#sale-product-detail').DataTable().ajax.reload();
                $('#products-list').DataTable().ajax.reload();
                console.log(data.message);
            });
        });

        $('#reset-transaction').on('click', function () {
            let url = '{{ route('api.transactions.reset-transaction', $sale->uuid) }}';

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to reset transaction?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        dataType: 'json',
                    }).always(function (data) {
                        if (data.status !== 200) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: data.message,
                                confirmButtonText: 'Ok'
                            });
                        }
                        getSaleDetail();
                        $('#sale-product-detail').DataTable().ajax.reload();
                        $('#products-list').DataTable().ajax.reload();
                        console.log(data.message);
                    });
                }
            });
        })

        $('#sale-form').on('submit', function (e) {
            e.preventDefault();
            let url = '{{ route('transactions.save', $sale->uuid) }}';

            Swal.fire({
                title: 'Are you sure?',
                text: 'Make sure all done before save this transaction',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            notes: $('#notes').val(),
                        }
                    }).always(function (data) {
                        if (data.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                confirmButtonText: 'Ok'
                            }).then(function () {
                                let url = data.url

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
                                        window.location.href = url;
                                    }, 500);
                                });
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: data.message,
                                confirmButtonText: 'Ok'
                            });
                        }
                        getSaleDetail();
                        $('#sale-product-detail').DataTable().ajax.reload();
                        $('#products-list').DataTable().ajax.reload();
                        console.log(data.message);
                    });
                }
            });
        });

        $('#cancel-transaction').on('click', function (e) {
            e.preventDefault();
            let url = '{{ route('transactions.cancel', $sale->uuid) }}';

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to cancel "{{ $sale->invoice }}" transaction?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        }
                    }).always(function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            confirmButtonText: 'Ok'
                        }).then(function () {
                            window.location.href = data.url;
                        });
                    })
                }
            });
        });

        function getSaleDetail() {
            $.ajax({
                url: '{{ route('api.transactions.get-sale-by-uuid', $sale->uuid) }}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#total-preview-text').text('Rp. ' + data.data.total.formatted);
                    $('#invoice-preview-text').text(data.data.invoice);
                    $('#transaction-date-preview-text').text(data.data.transaction_date);
                    $('#cashier-name-preview-text').text(data.data.cashier);
                    $('#subtotal-preview').val(data.data.subtotal.formatted);
                    $('#saved-preview').val(data.data.saved.formatted);
                    $('#total-preview').val(data.data.total.formatted);
                    $('#change').val(data.data.change.formatted);
                    $('#discount').inputmask("numeric", {
                        min: 0,
                        max: 100,
                        allowMinus: false,
                        allowZero: false,
                        rightAlign: false,
                        radixPoint: ".",
                        digits: 2,
                    });
                    $('#received').inputmask("currency", {
                        min: 0,
                        allowMinus: false,
                        allowZero: false,
                        rightAlign: false,
                        radixPoint: ",",
                        groupSeparator: ".",
                        digits: 0,
                    });
                    $('#discount').val(data.data.discount);
                    $('#received').val(data.data.received.formatted);
                    console.log(data.message);

                    if (data.data.total.raw <= data.data.received.raw && data.data.total.raw > 0) {
                        $('#save-transaction').attr('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
                    } else {
                        $('#save-transaction').attr('disabled', true).removeClass('btn-primary').addClass('btn-secondary');
                    }

                    if (data.data.change.raw < 0) {
                        $('#change-label').text('Kurang');
                    } else {
                        $('#change-label').text('Kembalian');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        getSaleDetail();
    </script>
@endpush
