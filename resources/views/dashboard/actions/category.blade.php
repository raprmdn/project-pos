<div class="row">
    @can('edit-category')
        <a href="{{ route('category.edit', $category->slug) }}" class="btn btn-primary mr-2" title="Edit category">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete-category')
        <button class="btn btn-danger delete-item"
                title="Delete category"
                data-url="{{ route('category.destroy', $category->slug) }}"
                data-name="{{ $category->name }}">
            <i class="fas fa-trash"></i>
        </button>
    @endcan
</div>
