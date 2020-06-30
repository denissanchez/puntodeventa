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
            $table->unsignedBigInteger('store_id');
            $table->string('code')->nullable();
            $table->string('origin_code')->nullable();
            $table->string('category');
            $table->string('brand');
            $table->string('laboratory')->default('-');
            $table->string('measure_unit');
            $table->string('name');
            $table->string('composition')->nullable();
            $table->string('description');
            $table->decimal('unit_price', 6, 2)->default(0)->unsigned();
            $table->decimal('purchased_units', 6, 2)->default(0)->unsigned();
            $table->decimal('sold_units', 6, 2)->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade')->onDelete('cascade');
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
