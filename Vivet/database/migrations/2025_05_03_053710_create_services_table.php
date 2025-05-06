<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('estimated_duration');
            $table->unsignedBigInteger('price');
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        Schema::table('appointments', function (Blueprint $table) {
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
        // Elimina la columna service_id de appointments si existe (revisar)
        if (Schema::hasTable('appointments')) {
            Schema::table('appointments', function (Blueprint $table) {
                if (Schema::hasColumn('appointments', 'service_id')) {
                    try {
                        $table->dropForeign(['service_id']);
                    } catch (\Illuminate\Database\QueryException $e) {

                    }
                    $table->dropColumn('service_id');
                }
            });
        }
        Schema::dropIfExists('services');
    }
};
