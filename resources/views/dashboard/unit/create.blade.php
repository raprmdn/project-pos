@extends('dashboard.layouts.app')
@section('title')
    Tambah Unit
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Unit</h3>
                </div>
                <form method="post" action="{{ route('unit.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Unit</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror @error('slug') is-invalid @enderror"
                                   id="name"
                                   placeholder="Masukkan nama" name="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            @error('slug')
                            <span class="error invalid-feedback">field name exist</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
