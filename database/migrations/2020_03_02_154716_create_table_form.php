<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_form', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('typedata');
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('table_category')->onDelete('cascade');
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
        Schema::dropIfExists('table_form');
    }
}
