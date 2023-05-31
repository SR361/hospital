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
        Schema::create('trainee_units_capacities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('units_id')->unsigned()->nullable();
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('training_id')->unsigned()->nullable();
            // $table->foreign('training_id ')->references('id')->on('trainings')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', [1, 0])->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainee_units_capacities');
    }
};
