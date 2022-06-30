<div class="row">
  <button class="btn btn-primary btn-xs mr-2" type="button" id="edit-order-detail-button"
    data-order-detail-id="{{ $order->id }}" data-order-detail-qty="{{ $order->qty }}"
    data-product-id="{{ $order->product->id }}" data-product-name="{{ $order->product->name }}"
    data-order-detail-total="{{ $order->total }}" title="Edit product" data-toggle="modal" data-target="#editProduct">
    <i class="fas fa-edit"></i>
  </button>
  <button class="btn btn-danger btn-xs" type="button" id="delete-order-detail-button"
    data-product-id="{{ $order->product->id }}" data-product-name="{{ $order->product->name }}"
    title="Delete product">
    <i class="fas fa-trash"></i>
  </button>
</div>
