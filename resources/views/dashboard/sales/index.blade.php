@extends('dashboard.layouts.app')

@section('title', 'Sales')

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Sales</li>
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
  @if (session('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <i class="icon fas fa-check"></i>
      {{ session('success') }}
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <i class="icon fas fa-exclamation-triangle"></i>
      {{ session('error') }}
    </div>
  @endif

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h4>Sales</h4>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Create Transaction</a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover" id="sales-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Cashier</th>
                <th>Total Items</th>
                <th>Subtotal</th>
                <th>Discount</th>
                <th>Total</th>
                <th>Status</th>
                <th>Transaction Date</th>
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
    let format = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR'
    })
    $(function() {
      $('#sales-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('sales.table') }}',
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            searchable: false,
            orderable: false
          },
          {
            data: 'invoice',
            name: 'invoice'
          },
          {
            data: 'cashier',
            name: 'cashier'
          },
          {
            data: 'total_items',
            name: 'total_items'
          },
          {
            data: 'subtotal',
            name: 'subtotal'
          },
          {
            data: 'discount',
            name: 'discount'
          },
          {
            data: 'total',
            name: 'total'
          },
          {
            data: 'status',
            name: 'status'
          },
          {
            data: 'created_at',
            name: 'created_at'
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
    $("#sales-table").on("click", "#print-invoice", function(e) {
      function formatNum(num) {
        let reverse = num.toString().split('').reverse().join(''),
          ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
      }
      $.ajax({
        url: $(this).data("url"),
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
                              ${data.sale_details.map((sale_detail)=>{
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
        setTimeout(function() {
          window.frames["frame1"].focus();
          window.frames["frame1"].print();
          document.body.removeChild(frame1);
        }, 500);
        return false;
      });
    });
    $('#sales-table').on('click', '#cancel-transaction', function(e) {
      e.preventDefault();
      let invoice = $(this).data('invoice');
      let url = $(this).data('url');

      Swal.fire({
        title: 'Are you sure?',
        text: `You want to cancel "${invoice}" transaction?`,
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
          }).always(function(data) {
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: data.message,
              confirmButtonText: 'Ok'
            }).then(function() {
              $('#sales-table').DataTable().ajax.reload();
            });
          })
        }
      });
    });
  </script>
@endpush
