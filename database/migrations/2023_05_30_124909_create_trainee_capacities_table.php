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
        Schema::create('trainee_capacities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('units_id')->unsigned()->nullable();
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->string('capcaity',500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_capacities');
    }
};
