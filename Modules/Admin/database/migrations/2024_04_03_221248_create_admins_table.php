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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('userName')->unique();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('system')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        // use Illuminate\Database\Migrations\Migration;
        // use Illuminate\Database\Schema\Blueprint;
        // use Illuminate\Support\Facades\Schema;
        Schema::table('admins', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->unsignedBigInteger('role_id')->default(1); // 1 = Data Entry 
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
