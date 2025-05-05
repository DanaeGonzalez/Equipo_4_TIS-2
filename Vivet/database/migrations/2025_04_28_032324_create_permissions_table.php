<?php

// database/migrations/2025_04_20_123456_create_permissions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            //$table->bigIncrements('permission_id');
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            //$table->timestamps();
        });
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('role_id'); 
            $table->unsignedBigInteger('permission_id'); 
            //$table->timestamps();

            //Claves foráneas
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('permissions');
    }
}

