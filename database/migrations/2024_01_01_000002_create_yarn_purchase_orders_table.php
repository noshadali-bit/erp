<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yarn_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
            $table->date('expected_delivery_date');
            $table->enum('status', ['pending', 'completed']);
            $table->timestamps();
        });

        Schema::create('yarn_purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('yarn_purchase_order_id')->constrained('yarn_purchase_orders')->onDelete('cascade');
            $table->string('yarn_type');
            $table->string('count');
            $table->decimal('quantity', 10, 2);
            $table->decimal('rate', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('yarn_purchase_order_items');
        Schema::dropIfExists('yarn_purchase_orders');
    }
};