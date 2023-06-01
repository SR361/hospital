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
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('name',500)->nullable();
            $table->string('image',500)->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->bigInteger('training_id')->unsigned()->nullable();
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->onUpdate('cascade');
            $table->text('location')->nullable();
            $table->bigInteger('ls_id')->unsigned()->nullable();
            $table->foreign('ls_id')->references('id')->on('learning_specialties')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('units_id')->unsigned()->nullable();
            $table->foreign('units_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->text('university')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};
