<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%")
                  ->orWhere('brand', 'LIKE', "%{$request->search}%")
                  ->orWhere('category', 'LIKE', "%{$request->search}%")
                  ->orWhere('description', 'LIKE', "%{$request->search}%");
        }

        if ($request->has('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('colour')) {
            $query->where('colour', $request->colour);
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'original_price' => 'required|numeric',
            'variant_name' => 'nullable|string|max:255',
            'variant' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'selling_price' => 'required|numeric',
            'colour' => 'required|string|max:255',
            'images.*' => 'required|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('images')) {
            $data['images'] = array_map(function ($image) {
                return $image->store('products', 'public');
            }, $request->file('images'));
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'original_price' => 'required|numeric',
        'variant_name' => 'nullable|string|max:255',
        'variant' => 'nullable|string|max:255',
        'weight' => 'nullable|numeric',
        'selling_price' => 'required|numeric',
        'colour' => 'required|string|max:255',
        'images.*' => 'nullable|image',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('images')) {
        if (is_array($product->images)) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $data['images'] = array_map(function ($image) {
            return $image->store('products', 'public');
        }, $request->file('images'));
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

    public function destroy(Product $product)
    {
        if (is_array($product->images)) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
