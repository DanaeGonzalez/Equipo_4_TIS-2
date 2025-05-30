<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();       
            //$table->json('data');                // Aquí se guarda name, email, etc.
            $table->string('name');
            $table->string('email');
            $table->string('subdomain')->unique();
            $table->json('data')->nullable(); //Para evitar errores con tenancy
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
