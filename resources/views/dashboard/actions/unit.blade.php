<div class="row">
    @can('edit-unit')
        <a href="{{ route('unit.edit', $unit->slug) }}" class="btn btn-primary mr-2" title="Edit unit">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete-unit')
        <button class="btn btn-danger delete-item"
                data-url="{{ route('unit.destroy', $unit->slug) }}"
                data-name="{{ $unit->name }}">
            <i class="fas fa-trash"></i>
        </button>
    @endcan
</div>
