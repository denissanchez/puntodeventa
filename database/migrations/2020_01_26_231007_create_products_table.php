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
            $table->unsignedBigInteger('branch_id');
            $table->string('code')->nullable();
            $table->string('category');
            $table->string('brand');
            $table->string('laboratory');
            $table->string('measure_unit');
            $table->string('name');
            $table->string('composition');
            $table->string('description');
            $table->decimal('unit_price', 6, 2)->default(0)->unsigned();
            $table->decimal('purchased_units', 6, 2)->default(0)->unsigned();
            $table->decimal('sold_units', 6, 2)->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
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
