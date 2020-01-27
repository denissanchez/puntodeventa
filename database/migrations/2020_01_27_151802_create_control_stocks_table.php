<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlStocksTable extends Migration
{
    public function up()
    {
        Schema::create('control_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('product_id');
            $table->string('user_name');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('document_code');
            $table->string('type');
            $table->decimal('quantity', 8, 2);
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('control_stocks');
    }
}
