<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_detail_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_detail_id');
            $table->unsignedBigInteger('sale_detail_id');
            $table->decimal('quantity', 8, 2);

            $table->foreign('purchase_detail_id')->references('id')->on('purchase_details');
            $table->foreign('sale_detail_id')->references('id')->on('sale_details');
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
        Schema::dropIfExists('sale_detail_controls');
    }
}
