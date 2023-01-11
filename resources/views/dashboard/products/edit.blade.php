@extends('dashboard.layouts.app')

@section('title', 'Product : ' . $product->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Product : {{ $product->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product : {{ $product->name }}</h4>
                </div>
                <form action="{{ route('products.update', $product->slug) }}" method="POST"
                      enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    @include('dashboard.products.partials.form-control')
                </form>
            </div>
        </div>
    </div>
@endsection
