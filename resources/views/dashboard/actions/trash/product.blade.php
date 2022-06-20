<div class="row">
    @can('restore-product')
        <button class="btn btn-primary restore-item"
                title="Restore product"
                data-url="{{ route('trash.products.restore', $product->slug) }}"
                data-name="{{ $product->name }}">
            <i class="fas fa-undo-alt"></i>
        </button>
    @endcan
</div>
