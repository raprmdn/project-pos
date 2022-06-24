<div class="card-body">
    <div class="form-group">
        <label for="permission_name">Permission Name</label>
        <input type="text" class="form-control @error('permission_name') is-invalid @enderror" id="permission_name"
               name="permission_name"
               value="{{ old('permission_name') ?? $permission->name }}"
               placeholder="Enter permission name">
        @error('permission_name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="guard_name" title="Default: web">Guard Name</label>
        <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name"
               name="guard_name"
               value="{{ old('guard_name') ?? $permission->guard_name }}"
               placeholder="Enter guard name">
        @error('guard_name')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="card-footer text-right">
    <button type="submit" class="btn btn-primary {{ $button ?? 'update' }}">{{ $button ?? 'Update' }}</button>
    @if(request()->route()->getName() == 'permissions.edit')
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
    @endif
</div>
