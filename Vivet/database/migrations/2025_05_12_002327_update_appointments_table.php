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
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'schedule_id')) {
                $table->unsignedBigInteger('schedule_id')->nullable()->after('id');

                $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            }
            if (!Schema::hasColumn('appointments', 'service_id')) {
                $table->unsignedBigInteger('service_id')->nullable()->after('vet_id');

                $table->foreign('service_id')
                    ->references('id')
                    ->on('services')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Revisa si la columna y la FK existen antes de eliminar
            if (Schema::hasColumn('appointments', 'schedule_id')) {
                try {
                    $table->dropForeign(['schedule_id']);
                } catch (\Throwable $e) {
                    // Ignorar si no existe
                }
                $table->dropColumn('schedule_id');
            }

            if (Schema::hasColumn('appointments', 'service_id')) {
                try {
                    $table->dropForeign(['service_id']);
                } catch (\Throwable $e) {
                    // Ignorar si no existe
                }
                $table->dropColumn('service_id');
            }
        });
    }
};
