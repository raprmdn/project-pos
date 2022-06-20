<div class="row">
    @can('restore-supplier')
        <button class="btn btn-primary restore-item"
                title="Restore supplier"
                data-url="{{ route('trash.suppliers.restore', $supplier->slug) }}"
                data-name="{{ $supplier->name }}">
            <i class="fas fa-undo-alt"></i>
        </button>
    @endcan
</div>
