<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('attribute_value_id');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values');
            $table->unsignedInteger('film_attribute_id');
            $table->foreign('film_attribute_id')->references('id')->on('film_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films_attributes');
    }
}
