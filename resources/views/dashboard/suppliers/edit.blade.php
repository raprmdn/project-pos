@extends('dashboard.layouts.app')

@section('title', 'Supplier : ' . $supplier->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Supplier : {{ $supplier->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Supplier : {{ $supplier->name }}</h4>
                </div>
                <form action="{{ route('suppliers.update', $supplier->slug) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Supplier</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror @error('slug') is-invalid @enderror"
                                   id="name" placeholder="Masukkan nama" name="name" value="{{ $supplier->name }}">
                            @error('name')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            @error('slug')
                            <span class="error invalid-feedback">field name exist</span>
                            @enderror
                            <label for="address">Alamat Supplier</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                   placeholder="Masukkan alamat" name="address" value="{{ $supplier->address }}">
                            @error('address')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            <label for="phone">No. Telepon Supplier</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                   placeholder="Masukkan nomor telepon" name="phone" value="{{ $supplier->phone }}">
                            @error('phone')
                            <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            <label for="description">Deskripsi Supplier</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      id="description"
                                      rows="3" placeholder="Masukkan deskripsi">{{ $supplier->description }}</textarea>
                            @error('description')
                            <span class="error invalid-feedback">{{ $message }}</span>
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
