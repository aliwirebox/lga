<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawFirmBandsLawFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law_firm_bands_law_firms', function (Blueprint $table) {
            $table->integer('law_firms_id')->unsigned()->index();
            $table->integer('law_firm_bands_id')->unsigned()->index();
            $table->primary(['law_firms_id', 'law_firm_bands_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('law_firm_bands_law_firms');
    }
}
