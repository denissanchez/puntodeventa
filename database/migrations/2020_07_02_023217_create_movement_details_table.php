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
            $table->float('price', 8, 2);
            $table->float('price_defined', 8, 2);
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
        Schema::dropIfExists('movement_details');
    }
}
