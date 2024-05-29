<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'category',
        'original_price',
        'variant_name',
        'variant',
        'weight',
        'selling_price',
        'colour',
        'images',
        'description',
    ];

    protected $casts = [
        'images' => 'array', // Ensure this cast is present
    ];

    // Delete images from storage when the product is deleted
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            if (is_array($product->images)) { // Ensure images is an array
                foreach ($product->images as $image) {
                    Storage::disk('public')->delete($image); // Specify the public disk
                }
            }
        });
    }
}
