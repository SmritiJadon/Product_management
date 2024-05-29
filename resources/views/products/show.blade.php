@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>{{ $product->name }}</h1>
            <p class="lead">Brand: {{ $product->brand }}</p>
            <p class="lead">Category: {{ $product->category }}</p>
            <p class="lead">Original Price: ${{ $product->original_price }}</p>
            @if($product->category == 'fashion')
                <p class="lead">Variant Name: {{ $product->variant_name }}</p>
                <p class="lead">Variant: {{ $product->variant }}</p>
            @elseif($product->category == 'toys')
                <p class="lead">Weight: {{ $product->weight }} lbs</p>
            @endif
            <p class="lead">Selling Price: ${{ $product->selling_price }}</p>
            <p class="lead">Colour: {{ $product->colour }}</p>
            <p class="lead">Description: {{ $product->description }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to List</a>
        </div>
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Images</h5>
                    <div class="row">
                        @foreach($product->images as $image)
                        <div class="col-md-4 mb-3">
                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid" alt="Product Image">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
