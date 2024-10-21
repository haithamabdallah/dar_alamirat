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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->date('birthday');
            $table->enum('gender', ['male', 'female']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            // Change the 'email' column to be unique and indexed
            $table->string('email')->index()->change();
            // Add 'email_verified_at' column with nullable timestamps
            $table->timestamp('email_verified_at')->nullable()->change();
            // Uncomment and change the 'password' column if needed
            // $table->string('password')->change();
            // Add or change the 'first_name' column to be nullable
            $table->string('first_name')->nullable()->change();
            // Add or change the 'last_name' column to be nullable
            $table->string('last_name')->nullable()->change();
            // Add or change the 'phone_number' column to be nullable
            $table->string('phone_number')->nullable()->change();
            // Add or change the 'birthday' column to be a nullable date
            $table->date('birthday')->nullable()->change();
            // Add or change the 'gender' column to be an enum with 'male' and 'female' options, nullable
            $table->enum('gender', ['male', 'female'])->nullable()->change();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('password');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->after('last_name', function ($table) {
                $table->string('avatar')->nullable();
            });
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->string('email')->unique()->nullable()->change();
            $table->after('email', function ($table) {
                $table->string('guest_email')->nullable();
            });
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('users', function (Blueprint $table) {
            // Revert changes if needed
            $table->string('email')->change();
            $table->dropUnique(['email']);
            $table->dropIndex(['email']);
            $table->dropIndex(['password']);
            $table->timestamp('email_verified_at')->nullable(false)->change();

            // Uncomment and revert the 'password' column if needed
            // $table->string('password')->change();

            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->string('gender')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->change();
            $table->string('password')->change();
        });
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
