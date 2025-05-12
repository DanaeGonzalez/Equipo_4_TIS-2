<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); //preguntar
            $table->string('name');
            $table->text('description');
            $table->string('species');
            $table->integer('validity_period');
            $table->timestamps();
        });
        
        
        Schema::create('pet_vaccinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_id');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->unsignedBigInteger('vaccine_id');
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
            $table->unsignedBigInteger('vet_id');
            $table->foreign('vet_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('application_date');
            $table->date('next_due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_vaccinations');
        Schema::dropIfExists('vaccines');
    }
};
