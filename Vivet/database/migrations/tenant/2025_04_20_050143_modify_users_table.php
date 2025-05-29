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
        Schema::table('users', function (Blueprint $table) {
         // Verifica si la columna 'role_id' ya existe, si no, la agregamos
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->bigInteger('role_id')->unsigned()->nullable()->after('user_id');
            }

        // Agrega otras columnas o modificaciones necesarias
        // $table->string('another_column');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
