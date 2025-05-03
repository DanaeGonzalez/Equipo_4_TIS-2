<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('user_type')->default('Paciente')->after('id');
            $table->boolean('is_active')->default(true)->after('user_type');
        });


        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tipo_usuario');
            $table->dropColumn('es_activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tipo_usuario')->default('Tutor')->after('id');
            $table->boolean('es_activo')->default(true)->after('tipo_usuario');
        });

        // Eliminar las columnas nuevas
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type');
            $table->dropColumn('is_active');
        });
    }
}
