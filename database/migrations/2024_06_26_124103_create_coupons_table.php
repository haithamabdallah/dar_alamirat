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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('note')->nullable()->comment('note about the coupon');
            $table->string('code' , 30)->nullable();
            $table->decimal('discount_value', 8, 2)->nullable();
            $table->enum('discount_type', ['flat', 'percent'])->nullable();
            $table->boolean('status')->default(1);
            $table->string('start_date' , 30)->nullable()->comment('ex. 2022-02-22');
            $table->string('end_date' , 30)->nullable()->comment('ex. 2022-02-22');
            $table->unsignedInteger('limit_per_user')->nullable(); // has a pivot table ( coupon_users ) )
            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('usage_count')->default(0);
            $table->timestamps();
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->after('end_date', function (Blueprint $table) {
                $table->decimal('min_purchase_limit', 10, 2)->default(100);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
