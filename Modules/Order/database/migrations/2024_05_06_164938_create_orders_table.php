<?php

use Modules\Order\Enums\OrderStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Order\Enums\PaymentStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('order_number');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('user_address_id')->nullable();
            $table->enum('payment_status', PaymentStatus::getValues())->default(PaymentStatus::PENDING);
            $table->enum('status', OrderStatus::getValues())->default(OrderStatus::PENDING);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('set null');
            // $table->foreign('user_address_id')->references('id')->on('user_addresses')->onDelete('set null');
        });

        // if (Schema::hasTable('order_product')) {
        //     Schema::table('order_product', function (Blueprint $table) {
        //         $table->foreign('order_id')->on('orders')->references('id')->onDelete('cascade');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // if (Schema::hasTable('order_product')) {
        //     Schema::table('order_product', function (Blueprint $table) {
        //         $table->dropForeign(['order_id']);
        //     });
        // }


        Schema::dropIfExists('orders');
    }
};

// php artisan module:migrate-rollback --subpath="2024_05_06_164938_create_orders_table.php" Order
// php artisan module:migrate --subpath="2024_05_06_164938_create_orders_table.php" Order