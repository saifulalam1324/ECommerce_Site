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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('customer_id')
                ->constrained('customers', 'customer_id')
                ->onDelete('cascade');
            $table->foreignId('vendor_id')
                ->constrained('vendors', 'vendor_id')
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained('products', 'product_id')
                ->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('order_batch_id');
            $table->tinyInteger('status')->default(0);
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
