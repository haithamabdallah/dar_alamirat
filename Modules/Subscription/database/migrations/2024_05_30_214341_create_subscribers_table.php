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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::table('subscribers', function (Blueprint $table) {
            $table->after('email', function (Blueprint $table) {
                $table->boolean('status')->default(0);
                $table->string('token')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {        
        Schema::dropIfExists('subscribers');
    }
};

// use tinker
/* 
Schema::table('subscribers', function (Blueprint $table) {
    $table->dropColumn('content');
});
 */