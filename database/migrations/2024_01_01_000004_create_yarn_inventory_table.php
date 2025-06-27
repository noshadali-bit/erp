<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yarn_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->string('yarn_type');
            $table->decimal('bags', 10, 2)->default(0);
            $table->decimal('cones', 10, 2)->default(0);
            $table->decimal('kg', 10, 2)->default(0);
            $table->decimal('pieces', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('yarn_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_department_id')->constrained('departments');
            $table->foreignId('to_department_id')->constrained('departments');
            $table->decimal('quantity', 10, 2);
            $table->string('unit_type'); // bags, cones, kg, pieces
            $table->date('movement_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('yarn_movements');
        Schema::dropIfExists('yarn_inventory');
    }
};