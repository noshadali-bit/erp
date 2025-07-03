<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('email_data', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('domain_name')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_data');
    }
};