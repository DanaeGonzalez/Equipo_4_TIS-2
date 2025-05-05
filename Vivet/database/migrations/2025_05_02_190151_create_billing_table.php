<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('appointment_id')->nullable();
            //$table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('set null');
            $table->unsignedBigInteger('total_amount');
            $table->enum('payment_method',['Efectivo', 'Crédito', 'Débito']);
            $table->date('payment_date');
            $table->enum('status',['Pendiente', 'Pagado', 'Cancelado']);
            $table->timestamps();
        });
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('stock');
            $table->timestamps();
        });

        Schema::create('billing_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')->references('id')->on('billing')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('unit_price');
            $table->unsignedBigInteger('total_price');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
        Schema::dropIfExists('billing_products');
        Schema::dropIfExists('products');
    }
};
