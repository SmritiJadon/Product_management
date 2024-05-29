@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Product List</h1>
    <form action="{{ route('products.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3 mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" name="brand" class="form-control" placeholder="Brand" value="{{ request('brand') }}">
            </div>
            <div class="col-md-3 mb-3">
                <select name="category" class="form-control">
                    <option value="">Select Category</option>
                    <option value="fashion" {{ request('category') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                    <option value="toys" {{ request('category') == 'toys' ? 'selected' : '' }}>Toys</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" name="colour" class="form-control" placeholder="Colour" value="{{ request('colour') }}">
            </div>
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
            </div>
        </div>
    </form>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>

    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                <th>Colour</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->category }}</td>
                    <td>${{ number_format($product->original_price, 2) }}</td>
                    <td>${{ number_format($product->selling_price, 2) }}</td>
                    <td>{{ $product->colour }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($products->isEmpty())
        <div class="alert alert-info text-center">No products found. Try adjusting your filter criteria.</div>
    @endif
</div>
@endsection
