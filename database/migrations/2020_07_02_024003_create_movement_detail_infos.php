<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementDetailInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_detail_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('origin_movement_detail_id');
            $table->unsignedBigInteger('target_movement_detail_id');
            $table->float('quantity', 8, 2);

            $table->foreign('origin_movement_detail_id')->references('id')->on('movement_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('target_movement_detail_id')->references('id')->on('movement_details')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('movement_detail_infos');
    }
}
