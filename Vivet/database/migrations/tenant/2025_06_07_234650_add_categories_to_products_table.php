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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('category', ['Comida', 'Vacunas', 'Medicamentos', 'Accesorios', 'Suplementos'])->after('description');
        });
        
        if (Schema::hasColumn('products', 'is_vaccine')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_vaccine');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('products', 'is_vaccine')) {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_vaccine')->default(false)->after('stock');
            });
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
