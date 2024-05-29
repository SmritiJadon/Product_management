@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Product</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="cosmetics">Cosmetics</option>
                <option value="electronics">Electronics</option>
                <option value="fashion">Fashion</option>
                <option value="toys">Toys</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Original Price</label>
            <input type="number" class="form-control" id="original_price" name="original_price" required>
        </div>
        <div id="fashion-fields" style="display: none;">
            <div class="mb-3">
                <label for="variant_name" class="form-label">Variant Name</label>
                <input type="text" class="form-control" id="variant_name" name="variant_name">
            </div>
            <div class="mb-3">
                <label for="variant" class="form-label">Variant</label>
                <input type="text" class="form-control" id="variant" name="variant">
            </div>
        </div>
        <div id="toys-fields" style="display: none;">
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" id="weight" name="weight">
            </div>
        </div>
        <div class="mb-3">
            <label for="selling_price" class="form-label">Selling Price</label>
            <input type="number" class="form-control" id="selling_price" name="selling_price" required>
        </div>
        <div class="mb-3">
            <label for="colour" class="form-label">Colour</label>
            <input type="text" class="form-control" id="colour" name="colour" required>
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
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
