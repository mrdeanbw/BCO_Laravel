<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('organization')->nullable()->after('email');
            $table->string('city', 100)->nullable()->after('organization');
            $table->string('country', 100)->nullable()->after('city');
            $table->boolean('is_admin')->default(false)->after('password');
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
            $table->dropColumn('organization');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('is_admin');
        });
    }
}
