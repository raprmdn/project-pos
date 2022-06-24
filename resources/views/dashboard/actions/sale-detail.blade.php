<div class="row">
    <button class="btn btn-primary btn-xs mr-2"
            type="button"
            id="edit-sale-detail-button"
            data-sale-detail-id="{{ $saleDetail->id }}"
            data-sale-detail-qty="{{ $saleDetail->qty }}"
            data-product-id="{{ $saleDetail->product->id }}"
            data-product-name="{{ $saleDetail->product->name }}"
            data-product-stock="{{ $saleDetail->product->stock }}"
            title="Edit product">
        <i class="fas fa-edit"></i>
    </button>
    <button class="btn btn-danger btn-xs"
            type="button"
            id="delete-sale-detail-button"
            data-sale-detail-id="{{ $saleDetail->id }}"
            data-sale-detail-qty="{{ $saleDetail->qty }}"
            data-product-id="{{ $saleDetail->product->id }}"
            data-product-name="{{ $saleDetail->product->name }}"
            data-product-stock="{{ $saleDetail->product->stock }}"
            title="Delete product">
        <i class="fas fa-trash"></i>
    </button>
</div>
