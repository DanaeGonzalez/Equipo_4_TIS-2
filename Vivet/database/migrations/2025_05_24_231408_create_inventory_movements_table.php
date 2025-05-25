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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->enum('item_type', ['producto', 'insumo']);
            $table->unsignedBigInteger('item_id'); // ID del producto o insumo dependerá del item_type
            $table->enum('movement_type', ['entrada', 'salida']);
            $table->integer('quantity');
            $table->text('reason')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('setnull');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
