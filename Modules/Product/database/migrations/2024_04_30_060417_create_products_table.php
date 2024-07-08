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
            $table->json('title');
            $table->json('description');
            $table->json('instructions')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('slug');
            $table->boolean('active')->default(1);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->decimal('discount_value', 8, 2)->nullable();
            $table->enum('discount_type', ['flat', 'percent'])->nullable();
            $table->integer('most_sale')->default(0);
            $table->boolean('choice')->default(0);
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_returnable')->default(1);
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
