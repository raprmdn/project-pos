<div class="row">
    @can('restore-category')
        <button class="btn btn-primary restore-item"
                title="Restore category"
                data-url="{{ route('trash.categories.restore', $unit->slug) }}"
                data-name="{{ $unit->name }}">
            <i class="fas fa-undo-alt"></i>
        </button>
    @endcan
</div>
