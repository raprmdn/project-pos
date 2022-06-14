@extends('dashboard.layouts.app')
@php
$i = 1;
@endphp
@section('title')
  Unit
@endsection
@section('styles')
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h2 class="">Daftar Unit</h2>
            <a href="{{ route('unit.create') }}" class="btn btn-primary">Tambah Unit</a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-hover table-bordered dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ $d->slug }}</td>
                  <td>{{ $d->created_at }}</td>
                  <td>{{ $d->updated_at }}</td>
                  <td>
                    <form action="{{ route('unit.destroy', ['slug' => $d->slug]) }}" method="post"
                      onsubmit="return confirm('Apakah ingin menghapus data?')">
                      @csrf
                      @method('DELETE')
                      <a class="btn btn-warning" href="{{ route('unit.edit', ['slug' => $d->slug]) }}"><i
                          class="fa-pencil-alt fas"></i></a>
                      <button class="btn btn-danger" type="submit"><i class="fa-trash fas"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
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
    <script>
      $(".dataTable").DataTable()
    </script>
  @endpush
@endsection
