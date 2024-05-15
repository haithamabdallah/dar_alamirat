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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->integer('position')->nullable();
            $table->integer('priority')->nullable();
            $table->boolean('status')->default(1)->comment('0 = hidden | 1 = available');
            $table->enum('type' , ['default','banner']);
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
