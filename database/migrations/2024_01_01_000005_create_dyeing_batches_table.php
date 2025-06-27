<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dyeing_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_no')->unique();
            $table->string('color_info');
            $table->string('dye_type');
            $table->enum('process_status', ['pending', 'in_process', 'completed']);
            $table->decimal('quantity', 10, 2);
            $table->string('unit_type'); // kg or pieces
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dyeing_batches');
    }
};