<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('origin_code')->nullable();
            $table->string('internal_code')->nullable();
            $table->string('category')->nullable('-');
            $table->string('brand')->nullable('-');
            $table->string('laboratory')->nullable('-');
            $table->string('measure_unit')->nullable('-');
            $table->string('name');
            $table->string('composition')->nullable();
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
