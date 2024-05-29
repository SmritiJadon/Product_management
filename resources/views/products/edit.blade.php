@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ $product->brand }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="fashion" {{ $product->category == 'fashion' ? 'selected' : '' }}>Fashion</option>
                <option value="toys" {{ $product->category == 'toys' ? 'selected' : '' }}>Toys</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Original Price</label>
            <input type="number" class="form-control" id="original_price" name="original_price" value="{{ $product->original_price }}" required>
        </div>
        <div id="fashion-fields" style="display: {{ $product->category == 'fashion' ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="variant_name" class="form-label">Variant Name</label>
                <input type="text" class="form-control" id="variant_name" name="variant_name" value="{{ $product->variant_name }}">
            </div>
            <div class="mb-3">
                <label for="variant" class="form-label">Variant</label>
                <input type="text" class="form-control" id="variant" name="variant" value="{{ $product->variant }}">
            </div>
        </div>
        <div id="toys-fields" style="display: {{ $product->category == 'toys' ? 'block' : 'none' }};">
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight" value="{{ $product->weight }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="selling_price" class="form-label">Selling Price</label>
            <input type="number" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" required>
        </div>
        <div class="mb-3">
            <label for="colour" class="form-label">Colour</label>
            <input type="text" class="form-control" id="colour" name="colour" value="{{ $product->colour }}" required>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
            <div class="mt-2">
                <p>Current Images:</p>
                @foreach($product->images as $image)
                    <img src="{{ asset('storage/' . $image) }}" width="100" height="100" alt="Product Image">
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
document.getElementById('category').addEventListener('change', function () {
    var fashionFields = document.getElementById('fashion-fields');
    var toysFields = document.getElementById('toys-fields');
    if (this.value === 'fashion') {
        fashionFields.style.display = 'block';
        toysFields.style.display = 'none';
    } else if (this.value === 'toys') {
        fashionFields.style.display = 'none';
        toysFields.style.display = 'block';
    } else {
        fashionFields.style.display = 'none';
        toysFields.style.display = 'none';
    }
});
</script>
@endsection
