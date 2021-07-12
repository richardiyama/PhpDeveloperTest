<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('genre_id')
          ->constrained()
          ->onDelete('cascade');

          $table->foreignId('film_id')
          ->constrained()
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_genres');
    }
}
