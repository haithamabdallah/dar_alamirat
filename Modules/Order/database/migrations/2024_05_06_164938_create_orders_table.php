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
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->decimal('final_price', 10, 2)->nullable();
            // $table->enum('payment_status', PaymentStatus::getValues())->default(PaymentStatus::PENDING);
            // $table->enum('status', OrderStatus::getValues())->default(OrderStatus::PENDING);
            $table->string('payment_status')->default('pending');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('set null');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('set null');
            $table->foreign('user_address_id')->references('id')->on('user_addresses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

// php artisan module:migrate-rollback --subpath="2024_05_06_164938_create_orders_table.php" Order
// php artisan module:migrate --subpath="2024_05_06_164938_create_orders_table.php" Order
// truncate order_product table and then run this migration


/* # may need to use tinker 
** truncate order_product table 
Order
php artisan tinker

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Order\Models\OrderProduct;
use Modules\Order\Models\Order;

OrderProduct::truncate();

Order::all()->each(fn($order)=>$order->delete());   

** drop foreign key from order_product table
        if (Illuminate\Support\Facades\Schema::hasTable('order_product') && Illuminate\Support\Facades\Schema::hasTable('orders') && Illuminate\Support\Facades\Schema::hasColumn('order_product', 'order_id') && Illuminate\Support\Facades\Schema::hasColumn('orders', 'id') ) {
            Illuminate\Support\Facades\Schema::table('order_product', function (Blueprint $table) {
                $table->dropForeign(['order_id']);
            });
        }
** add foreign key to order_product table
            if (Schema::hasTable('order_product') && Schema::hasTable('orders') && Schema::hasColumn('order_product', 'order_id') && Schema::hasColumn('orders', 'id') ) {
            Schema::table('order_product', function (Blueprint $table) {
                $table->foreign('order_id')->on('orders')->references('id')->onDelete('cascade');
            });
        }




*/