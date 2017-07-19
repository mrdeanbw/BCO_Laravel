<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditCheckAndXfFields extends Migration
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
            $table->boolean('do_vendor_cc')->default(0);
            $table->string('business_legal_name')->nullable();
            $table->string('tax_id', 100)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('postal_code', 100)->nullable();
            $table->string('exf_username')->nullable();
            $table->string('exf_apitoken')->nullable();

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
            $table->dropColumn('do_vendor_cc');
            $table->dropColumn('tax_id');
            $table->dropColumn('street');
            $table->dropColumn('postal_code');
            $table->dropColumn('exf_username');
            $table->dropColumn('exf_apitoken');
            $table->dropColumn('business_legal_name');
            
        });
    }
}
