<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');

            // Datos de la cita
            $table->dateTime('appointment_date');
            $table->text('reason')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();

            // Foreign keys
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
