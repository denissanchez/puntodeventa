<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('document');
            $table->string('name');
            $table->string('address')->nullable($value = '-');
            $table->string('phone')->nullable($value = '-');
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
        Schema::dropIfExists('owner_documents');
    }
}
