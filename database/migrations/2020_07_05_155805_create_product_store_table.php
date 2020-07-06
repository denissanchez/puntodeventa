<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_store', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('store_id');
            $table->decimal('unit_price', 6, 2)->default(0)->unsigned();
            $table->decimal('minimun_quantity', 6, 2)->default(0)->unsigned();
            $table->decimal('purchased_units', 6, 2)->default(0)->unsigned();
            $table->decimal('sold_units', 6, 2)->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('product_store');
    }
}
