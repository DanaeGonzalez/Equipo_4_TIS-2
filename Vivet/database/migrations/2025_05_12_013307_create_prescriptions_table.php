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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinical_record_id')->nullable();
            $table->foreign('clinical_record_id')->references('id')->on('clinical_records')->onDelete('cascade');
            $table->unsignedBigInteger('medication_id')->nullable();
            $table->foreign('medication_id')->references('id')->on('medications')->onDelete('set null');
            $table->text('dosage');
            $table->string('duration');
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
