@extends('dashboard.layouts.app')

@section('title', 'Add User')

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Tambah User</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h4>Tambah User</h4>
        </div>
        <form action="{{ route('users.store') }}" method="POST" autocomplete="off">
          @csrf
          @include('dashboard.users.partials.form-control', ['button' => 'Submit'])
        </form>
      </div>
    </div>
  </div>
@endsection
