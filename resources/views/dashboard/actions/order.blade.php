<div class="row">
  @if ($order->status === 'completed')
    <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-primary btn-sm mr-2" title="View Order">
      <i class="fas fa-eye"></i>
    </a>
  @else
    <a href="{{ route('orders.manage', $order->uuid) }}" class="btn btn-warning btn-sm mr-2" title="Edit Order">
      <i class="fas fa-edit"></i>
    </a>
    <button type="button" class="btn btn-danger btn-sm" data-invoice="{{ $order->invoice }}"
      data-url="{{ route('order.cancel', $order->uuid) }}" id="cancel-order" title="Cancel Order">
      <i class="fas fa-times"></i>
    </button>
  @endif
</div>
