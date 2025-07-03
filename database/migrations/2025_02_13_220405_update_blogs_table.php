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
        Schema::table('blogs', function (Blueprint $table) {
            $table->integer('main_section')->default(0);
            $table->integer('whats_new')->default(0);
            $table->integer('top_story')->default(0);
            $table->integer('featured_posts')->default(0);
            $table->integer('popular')->default(0);
            $table->date('published_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('main_section');
            $table->dropColumn('whats_new');
            $table->dropColumn('top_story');
            $table->dropColumn('featured_posts');
            $table->dropColumn('popular');
            $table->dropColumn('published_date');
            
        });
    }
};
