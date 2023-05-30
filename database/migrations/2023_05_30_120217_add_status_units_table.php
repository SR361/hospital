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
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('ls');
        });

        Schema::table('units', function (Blueprint $table) {
            $table->bigInteger('ls_id')->after('short_name')->unsigned()->nullable();
            $table->foreign('ls_id')->references('id')->on('learning_specialties')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', [1, 0])->after('ls_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['ls_id']);
            $table->dropColumn('ls_id');
            $table->dropColumn('status');
        });
        Schema::table('units', function (Blueprint $table) {
            $table->string('ls',500)->after('short_name');
        });
    }
};
