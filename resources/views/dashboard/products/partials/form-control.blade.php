<div class="card-body">
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
               name="product_name" value="{{ old('product_name') ?? $product->name }}" placeholder="Enter product name">
        @error('product_name')
        <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="category">Product Category</label>
        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
            <option value="" hidden>Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category')
        <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="unit">Product Unit</label>
        <select class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit">
            <option value="" hidden>Select unit</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" @if ($product->unit_id == $unit->id) selected @endif>
                    {{ $unit->name }}
                </option>
            @endforeach
        </select>
        @error('unit')
        <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="stock">Product Stock</label>
        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
               value="{{ $product->stock ?? 0 }}" placeholder="Enter product stock">
        @error('stock')
        <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">Product Price</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
               value="{{ old('price') ?? $product->price }}" placeholder="Enter product price">
        @error('price')
        <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea class="form-control" rows="3" id="description" name="description"
                  placeholder="Enter product description">{{ $product->description }}</textarea>
        @error('price')
        <span class="invalid-feedback" role="alert">
        {{ $message }}
      </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="product_image">Product Image</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('product_image') is-invalid @enderror"
                       id="product_image"
                       name="product_image">
                <label class="custom-file-label" for="product_image">Choose product image</label>
            </div>
        </div>
        @error('product_image')
        <small class="text-danger" role="alert">
            {{ $message }}
        </small>
        @enderror
        @if ($product->picture)
            <img src="{{ asset($product->product_picture) }}" alt="{{ $product->name }}" class="img-thumbnail"
                 width="100" height="100">
        @endif
    </div>
</div>
<div class="card-footer text-right">
    <button type="submit" class="btn btn-primary">{{ $button ?? 'Update' }}</button>
    @if (request()->route()->getName() == 'products.edit')
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    @endif
</div>

@push('scripts')
    <script src="{{ asset('dashboardpage/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboardpage/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
        $('#price').inputmask("currency", {
            min: 1,
            allowMinus: false,
            allowZero: false,
            rightAlign: false,
            radixPoint: ",",
            groupSeparator: ".",
            digits: 0,
        });

        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
