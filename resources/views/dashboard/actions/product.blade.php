<div class="row">
    @can('edit-product')
        <a href="{{ route('products.edit', $product->slug) }}" class="btn btn-primary mr-2" title="Edit product">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete-product')
        <button class="btn btn-danger delete-item"
                data-url="{{ route('products.destroy', $product->slug) }}"
                data-name="{{ $product->name }}">
            <i class="fas fa-trash"></i>
        </button>
    @endcan
</div>
