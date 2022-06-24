<div class="row">
    @if($product->stock > 0)
        <button class="btn btn-primary btn-xs selected-product"
                data-name="{{ $product->name }}"
                data-id="{{ $product->id }}">
            <i class="fas fa-check-circle"></i>
            Select
        </button>
    @else
        <span class="badge badge-danger">Out of stock</span>
    @endif
</div>
