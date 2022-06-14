@extends('dashboard.layouts.app')

@section('title', 'Add Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Tambah Product</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Product</h4>
                </div>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @include('dashboard.products.partials.form-control', ['button' => 'Submit'])
                </form>
            </div>
        </div>
    </div>
@endsection
