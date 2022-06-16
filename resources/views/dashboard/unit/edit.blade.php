@extends('dashboard.layouts.app')
@section('title')
  Ubah Unit
@endsection
@section('content')
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Ubah Unit</h3>
        </div>
        <form method="post" action="{{ route('unit.update', $data->slug) }}">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama Unit</label>
              <input type="text"
                class="form-control @error('name') is-invalid @enderror @error('slug') is-invalid @enderror" id="name"
                placeholder="Masukkan nama" name="name" value="{{ $data->name }}">
              @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
              @error('slug')
                <span class="error invalid-feedback">field name exist</span>
              @enderror
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-warning">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
