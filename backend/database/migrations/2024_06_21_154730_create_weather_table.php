<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->date('date')->index();
            $table->foreignId('weather_code')->constrained('weather_codes')->onUpdate('cascade')->onDelete('cascade');
            $table->float('temp_max', 4, 1)->nullable();
            $table->float('temp_min', 4, 1)->nullable();
            $table->integer('precipitation_probability')->nullable();
            $table->timestamps();

            $table->unique(['city_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather');
    }
}
