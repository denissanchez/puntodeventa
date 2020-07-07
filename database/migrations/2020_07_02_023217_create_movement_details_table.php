<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movement_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('item');
            $table->float('quantity', 8, 2);
            $table->float('current_quantity', 8, 2)->nullable();
            $table->float('price', 8, 2);
            $table->float('price_defined', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('movement_id')->references('id')->on('movements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movement_details');
    }
}
