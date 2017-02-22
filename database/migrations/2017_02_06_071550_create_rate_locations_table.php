<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 5);
            $table->string('display_name');
            $table->boolean('us_domestic');
            $table->string('name');
            $table->string('state', 2)->nullable();
            $table->string('country', 2);
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
        Schema::dropIfExists('rate_locations');
    }
}
