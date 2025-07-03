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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('color_4')->nullable();
            $table->text('lwaClientId')->nullable();
            $table->text('lwaClientSecret')->nullable();
            $table->text('awsAccessKeyId')->nullable();
            $table->text('awsSecretAccessKey')->nullable();
            $table->text('roleArn')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('color_4');
            $table->dropColumn('lwaClientId');
            $table->dropColumn('lwaClientSecret');
            $table->dropColumn('awsAccessKeyId');
            $table->dropColumn('awsSecretAccessKey');
            $table->dropColumn('roleArn');
        });
    }
};
