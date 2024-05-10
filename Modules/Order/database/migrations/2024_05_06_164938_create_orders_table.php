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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipping_id')->constrained()->onDelete('cascade');
            $table->enum('payment_status', PaymentStatus::getValues())->default(PaymentStatus::PENDING);
            $table->enum('status', OrderStatus::getValues())->default(OrderStatus::PENDING);
            $table->timestamps();



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
