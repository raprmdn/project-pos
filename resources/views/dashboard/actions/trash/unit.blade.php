<div class="row">
    @can('restore-unit')
        <button class="btn btn-primary restore-item"
                title="Restore unit"
                data-url="{{ route('trash.units.restore', $unit->slug) }}"
                data-name="{{ $unit->name }}">
            <i class="fas fa-undo-alt"></i>
        </button>
    @endcan
</div>
