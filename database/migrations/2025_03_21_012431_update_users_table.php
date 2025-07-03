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
        Schema::table('users', function (Blueprint $table) {
            $table->date('joining_date')->nullable();
            $table->string('designation')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('department_id')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('joining_date');
            $table->dropColumn('designation');
            $table->dropColumn('department_id');
            
        });
    }
};
