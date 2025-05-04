<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id'); // Relación al dueño (cliente)

            $table->string('name');
            $table->string('species');
            $table->string('breed')->nullable();
            $table->enum('sex',['macho', 'hembra']);
            $table->string('color')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('microchip_number')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
