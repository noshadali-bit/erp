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
        Schema::create('subscribtions', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->text('message')->nullable();
            $table->string('expire_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('plan_id')->nullable(); 
            $table->text('payment_response')->nullable();
            $table->integer('payment_status')->default(0);
            $table->string('price')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribtions');
    }
};
