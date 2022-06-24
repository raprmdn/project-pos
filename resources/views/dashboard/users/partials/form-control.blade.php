<div class="card-body">
  <div class="form-group">
    <label for="name">Nama User</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
      value="{{ old('name') ?? $user->name }}" placeholder="Masukkan nama">
    @error('name')
      <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="email">Email User</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
      value="{{ old('email') ?? $user->email }}" placeholder="Masukkan email">
    @error('email')
      <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
      placeholder="Masukkan password">
    @error('password')
      <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="role">Role</label>
    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
      <option value="" hidden>Pilih role</option>
      @foreach ($roles as $name)
        <option value="{{ $name }}" @if ($user->getRoleNames() == $name) selected @endif>
          {{ $name }}
        </option>
      @endforeach
    </select>
    @error('role')
      <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
    @enderror
  </div>
</div>
<div class="card-footer text-right">
  <button type="submit" class="btn btn-primary">{{ $button ?? 'Update' }}</button>
  @if (request()->route()->getName() == 'users.edit')
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
  @endif
</div>
