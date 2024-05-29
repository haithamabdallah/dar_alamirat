<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert changes if needed
            $table->string('email')->change();
            $table->dropUnique(['email']);
            $table->dropIndex(['email']);

            $table->timestamp('email_verified_at')->nullable(false)->change();

            // Uncomment and revert the 'password' column if needed
            // $table->string('password')->change();

            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->string('gender')->change();
        });
    }
}
