<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('famous_place_nearby')->nullable();
            $table->timestamps();
        });

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->after('famous_place_nearby', function($table) {
                $table->string('phone1')->nullable();
                $table->string('phone2')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropColumn('phone1');
            $table->dropColumn('phone2');
        });

        Schema::dropIfExists('user_addresses');
    }
};


/**
 * to rollback
 */
// php artisan tinker 
        /*  
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Support\Facades\DB;
        use Illuminate\Database\Schema\Blueprint;
        */


/**
 * to migrate
 */
// php artisan migrate --path=/database/migrations/2024_06_24_142534_create_user_addresses_table.php
