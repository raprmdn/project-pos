<div class="row">
    @if($sale->status === 'completed')
        <a href="{{ route('sales.show', $sale->uuid) }}" class="btn btn-primary btn-sm mr-2" title="View Transaction">
            <i class="fas fa-eye"></i>
        </a>
        <a href="#" class="btn btn-default btn-sm" title="Print Struck Transaction">
            <i class="fas fa-print"></i>
        </a>
    @else
        <a href="{{ route('transactions.index', $sale->uuid) }}" class="btn btn-warning btn-sm mr-2" title="Edit Transaction">
            <i class="fas fa-edit"></i>
        </a>
        <button type="button" class="btn btn-danger btn-sm"
                data-invoice="{{ $sale->invoice }}"
                data-url="{{ route('transactions.cancel', $sale->uuid) }}"
                id="cancel-transaction"
                title="Cancel Transaction">
            <i class="fas fa-times"></i>
        </button>
    @endif
</div>
