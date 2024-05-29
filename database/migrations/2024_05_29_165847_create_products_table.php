<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('category');
            $table->decimal('original_price', 8, 2);
            $table->string('variant_name')->nullable();
            $table->string('variant')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('selling_price', 8, 2);
            $table->string('colour');
            $table->text('description')->nullable();
            $table->json('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
