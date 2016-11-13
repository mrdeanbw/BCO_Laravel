<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('state', 100)->after('city')->nullable();
            $table->string('industry_type', 50)->nullable();
            $table->string('primary_commodity', 50)->nullable();
            $table->string('cargo_types', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('state');
            $table->dropColumn('industry_type');
            $table->dropColumn('primary_commodity');
            $table->dropColumn('cargo_types');
        });
    }
}
