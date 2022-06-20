<div class="row">
    @can('edit-supplier')
        <a href="{{ route('suppliers.edit', $supplier->slug) }}" class="btn btn-primary mr-2" title="Edit supplier">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete-supplier')
        <button class="btn btn-danger delete-item"
                data-url="{{ route('suppliers.destroy', $supplier->slug) }}"
                data-name="{{ $supplier->name }}">
            <i class="fas fa-trash"></i>
        </button>
    @endcan
</div>
