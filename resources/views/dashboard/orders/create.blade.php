@extends('dashboard.layouts.app')

@section('title', 'Order')

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Order</li>
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
                <h5 class="mb-3" id="order-date-preview-text"></h5>
                <small class="text-muted">
                  Supplier
                </small>
                <h5 class="mb-3" id="supplier-name-preview-text"></h5>
              </div>
              <div class="d-flex flex-column text-right">
                <small class="text-muted">
                  Invoice
                </small>
                <h1 class="font-weight-bolder mb-3" id="invoice-preview-text"></h1>
                <small class="text-muted">Total</small>
                <h1 class="font-weight-bolder mb-0" id="total-preview-text"></h1>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header justify-content-end d-flex">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#product">
              <i class="fas fa-search mr-1"></i>
              Select Product
            </button>
          </div>
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
                  <input type="text" class="form-control" id="total-preview" name="total-preview" readonly />
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="notes" class="col-sm-3 col-form-label">
                Notes
              </label>
              <div class="col-sm-9">
                <div class="input-group mb-3">
                  <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Notes"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-secondary mr-1" id="save-order">
              <i class="fas fa-save mr-1"></i>
              Save Order
            </button>
            <button type="button" class="btn btn-warning mr-1" id="reset-order">
              <i class="fas fa-redo-alt mr-1"></i>
              Reset
            </button>
            <button type="button" id="cancel-order" class="btn btn-danger mr-1">
              <i class="fas fa-times mr-1"></i>
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary d-none" id="modalLoadingSupplier" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <select class="form-control" name="supplier" id="selectSupplier">
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveSupplier"><span
              class="spinner-border spinner-border-sm text-white mr-1 d-none" role="status" id="loadingSupplier">
              <span class="sr-only">Loading...</span>
            </span>Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="product" tabindex="-1" aria-labelledby="productLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content position-relative">
        <div class="modal-header">
          <h5 class="modal-title" id="productLabel">Pilih Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table" id="products-list" style="width: 100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Barcode</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        <div class="position-absolute w-100 h-100 rounded d-none"
          style="top: 0; z-index: 3; background-color: rgba(0,0,0,0.5)" id="loadingSelectProduct">
          <div class="d-flex justify-content-center align-items-center h-100">
            <div class="spinner-border text-primary" id="modalLoadingSupplier" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="formEditProduct">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Product name</label>
              <input type="text" class="form-control" id="name" disabled>
            </div>
            <div class="form-group">
              <label for="qty">Qty</label>
              <input type="text" class="form-control" id="qty">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="updateDetailProduct">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="position-fixed top-0 right-0 px-3" style="z-index: 5; right: 0; top: 0; padding-top: 60px">
    <div id="liveToast" class="toast hide bg-success" role="alert" aria-live="assertive" aria-atomic="true"
      data-delay="2000">
      <div class="toast-header">
        <strong class="mr-auto">Sukses</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        Order has been reset
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
    let number = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR'
    })

    function getDetailOrder() {
        $.ajax({
            url: "{{ route('order.detail', $order->uuid) }}",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $("#order-date-preview-text").text(data.data.order_date)
                $("#supplier-name-preview-text").text(data.data.supplier)
                $("#invoice-preview-text").text(data.data.invoice)
                $("#total-preview-text").text('Rp. ' + data.data.total.formatted)
                $("#total-preview").val(data.data.total.formatted)
            }
        })
    }

    $(function() {
      getDetailOrder()
    })

    $('#products-list').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('select.products.order') }}',
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

    $("#products-list").on("click", ".selected-product", function () {
        $("#loadingSelectProduct").removeClass("d-none")
        $.ajax({
            url: "{{ route('order.detail.product.create', $order->uuid) }}",
            dataType: 'json',
            method: 'POST',
            data: {
                product_id: $(this).data("id"),
                _token: '{{ csrf_token() }}'
            },
            success: function () {
                $("#product").modal("hide")
                $("#loadingSelectProduct").addClass("d-none")
                $('#order-product-detail').DataTable().ajax.reload()
                getDetailOrder()
            }
        })
    })

    $("#order-product-detail").on('click', '#edit-order-detail-button', function () {
        $('#editProductLabel').text(`Edit qty ${$(this).data("product-name")}`)
        $("#name").val($(this).data("product-name"))
        $("#qty").val($(this).data("order-detail-qty"))
        $("#updateDetailProduct").data("product-id", $(this).data("product-id"))
    })

    $("#formEditProduct").submit(function(e) {
      e.preventDefault()
      $.ajax({
        url: '{{ route('orders.detail.product.update', $order->uuid) }}',
        method: 'PUT',
        dataType: 'json',
        data: {
          _token: '{{ csrf_token() }}',
          qty: $("#qty").val(),
          product_id: $("#updateDetailProduct").data("product-id")
        },
        success: function(result) {
          $('#order-product-detail').DataTable().ajax.reload()
          $("#editProduct").modal("hide")
          getDetailOrder()
        }
      })
    })

    $("#order-product-detail").on("click", "#delete-order-detail-button", function() {
      let name = $(this).data("product-name")
      Swal.fire({
        title: 'Are you sure?',
        text: `You want to delete "${name}" product?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '{{ route('orders.detail.product.delete', $order->uuid) }}',
            type: 'DELETE',
            dataType: 'json',
            data: {
              _token: '{{ csrf_token() }}',
              product_id: $(this).data("product-id"),
            }
          }).always(function(data) {
            if (data.status !== 200) {
              Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: data,
                confirmButtonText: 'Ok'
              });
            }
            getDetailOrder();
            $('#order-product-detail').DataTable().ajax.reload();
            $('#products-list').DataTable().ajax.reload();
          });
        }
      });
    })

    $("#order-form").submit(function(e) {
      e.preventDefault()
      $.ajax({
        url: '{{ route('order.save', $order->uuid) }}',
        method: 'PUT',
        dataType: 'json',
        data: {
          _token: '{{ csrf_token() }}',
          notes: $("#notes").val()
        },
        success: function(result) {
          if (result.status === 200) {
            window.location.href = '{{ route('orders.index') }}'
          } else {
            console.log(result);
          }
        }
      })
    })

    $("#reset-order").click(function() {
      Swal.fire({
        title: 'Are you sure?',
        text: `You want to reset order?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, reset it!'
      }).then((result) => {
        $.ajax({
          url: '{{ route('order.reset', $order->uuid) }}',
          method: 'DELETE',
          dataType: 'json',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function() {
            $('#order-product-detail').DataTable().ajax.reload()
            getDetailOrder()
            $("#liveToast").toast("show")
          }
        })
      })
    })

    $("#cancel-order").click(function() {
      Swal.fire({
        title: 'Are you sure?',
        text: `You want to cancel order?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, cancel it!'
      }).then((result) => {
        $.ajax({
          url: '{{ route('order.cancel', $order->uuid) }}',
          method: 'DELETE',
          dataType: 'json',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function() {
            Swal.fire({
              title: 'Success',
              text: 'Order canceled',
              icon: 'success',
              confirmButtonText: 'Ok'
            }).then((result) => {
              window.location.href = '{{ route('orders.index') }}'
            })
          }
        })
      })
    })
  </script>
@endpush
