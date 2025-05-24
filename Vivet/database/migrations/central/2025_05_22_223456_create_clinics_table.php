<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Nombre visible de la clínica
            $table->string('subdomain')->unique(); // subdominio: vivet, peluditos, etc.
            $table->string('domain')->unique();    // dominio completo: vivet.vetcodex.test
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
