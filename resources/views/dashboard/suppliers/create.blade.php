@extends('dashboard.layouts.app')
@section('title')
    Tambah Supplier
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Supplier</h3>
                </div>
                <form method="post" action="{{ route('suppliers.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Supplier</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror @error('slug') is-invalid @enderror"
                                   id="name" placeholder="Masukkan nama" name="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            @error('slug')
                            <span class="error invalid-feedback">field name exist</span>
                            @enderror
                            <label for="address">Alamat Supplier</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                   placeholder="Masukkan alamat" name="address" value="{{ old('address') }}">
                            @error('address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            <label for="phone">No. Telepon Supplier</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                   placeholder="Masukkan nomor telepon" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            <label for="description">Deskripsi Supplier</label>
                            <textarea class="form-control @error('phone') is-invalid @enderror" name="description"
                                      id="description" rows="3"
                                      placeholder="Masukkan deskripsi">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="error invalid-feedback">{{ $message }}</span>
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
