<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            //$table->bigIncrements('pet_id');
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('pet_name');
            $table->string('species');
            $table->string('breed')->nullable();
            $table->string('color');
            $table->enum('sex', ['Macho', 'Hembra']);
            $table->enum('status', ['Vivo','Fallecido','Hospitalizado'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('microchip_number')->nullable();
            $table->text('notes');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
