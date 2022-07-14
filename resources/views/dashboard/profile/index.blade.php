@extends('dashboard.layouts.app')

@section('title', 'Profile')

@section('breadcrumb')
  @parent
  <li class="breadcrumb-item active">Profile</li>
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('dashboardpage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboardpage/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h2 class="">Profile {{ auth()->user()->name }}</h2>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfile">Edit
              Profile</button>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
              <img
                src="{{ is_null(auth()->user()->photo) ? asset('dashboardpage/dist/img/user2-160x160.jpg') : asset('storage/' . auth()->user()->photo) }}"
                alt="" class="rounded-circle shadow" width="100" height="100" style="object-fit: cover">
            </div>

            <div class="col-md-8 col-12">
              <p>Nama : {{ auth()->user()->name }}</p>
              <p>Email : {{ auth()->user()->email }}</p>
              <p>Password : <button class="btn btn-warning" data-toggle="modal" data-target="#changePassword">Ubah
                  Password</button></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('user-profile-information.update') }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control @if ($errors->updateProfileInformation->get('name')) is-invalid @endif"
                id="name" name="name" aria-describedby="emailHelp" value="{{ auth()->user()->name }}">
              @if ($errors->updateProfileInformation->get('name'))
                <div class="invalid-feedback">
                  {{ $errors->updateProfileInformation->get('name')[0] }}
                </div>
              @endif
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control @if ($errors->updateProfileInformation->get('email')) is-invalid @endif"
                id="email" name="email" aria-describedby="emailHelp" value="{{ auth()->user()->email }}">
              @if ($errors->updateProfileInformation->get('email'))
                <div class="invalid-feedback">
                  {{ $errors->updateProfileInformation->get('email')[0] }}
                </div>
              @endif
            </div>
            <div class="form-group">
              <label for="photo">Foto Profil</label>
              <div class="input-group mb-3">
                <div class="custom-file @if ($errors->updateProfileInformation->get('photo')) is-invalid @endif">
                  <input type="file" class="custom-file-input" id="photo" name="photo"
                    aria-describedby="inputGroupFileAddon01">
                  <label class="custom-file-label" for="photo">Choose file</label>
                </div>
                @if ($errors->updateProfileInformation->get('photo'))
                  <div class="invalid-feedback">
                    {{ $errors->updateProfileInformation->get('photo')[0] }}
                  </div>
                @endif
              </div>
              <img src="{{ !is_null(auth()->user()->photo) ? asset('storage/' . auth()->user()->photo) : '' }}"
                alt="" width="100" height="100" id="previewImg"
                class="{{ is_null(auth()->user()->photo) ? 'd-none' : '' }}" style="object-fit: cover">
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('user-password.update') }}" method="post">
          @method('PUT')
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="current_password">Password Lama</label>
              <input type="password" class="form-control @if ($errors->updatePassword->get('current_password')) is-invalid @endif"
                id="current_password" name="current_password" aria-describedby="currentPasswordHelp">
              @if ($errors->updatePassword->get('current_password'))
                <div class="invalid-feedback">
                  {{ $errors->updatePassword->get('current_password')[0] }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="password">Password Baru</label>
              <input type="password" class="form-control @if ($errors->updatePassword->get('password')) is-invalid @endif"
                id="password" name="password" aria-describedby="passwordHelp">
              @if ($errors->updatePassword->get('password'))
                <div class="invalid-feedback">
                  {{ $errors->updatePassword->get('password')[0] }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label for="password_confirmation">Konfirmasi Password Baru</label>
              <input type="password" class="form-control @if ($errors->updatePassword->get('password_confirmation')) is-invalid @endif"
                id="password_confirmation" name="password_confirmation" aria-describedby="currentPasswordHelp">
              @if ($errors->updatePassword->get('password_confirmation'))
                <div class="invalid-feedback">
                  {{ $errors->updatePassword->get('password_confirmation')[0] }}
                </div>
              @endif
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $("#photo").change(function(e) {
      $("#previewImg").attr("src", `${URL.createObjectURL(e.target.files[0])}`)
      $("#previewImg").removeClass("d-none")
    })
  </script>
@endpush
