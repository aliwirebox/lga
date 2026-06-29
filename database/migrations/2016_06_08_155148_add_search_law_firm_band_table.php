<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchLawFirmBandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law_firm_band_search', function (Blueprint $table) {
            $table->integer('search_id');
            $table->integer('law_firm_band_id');
            $table->timestamps();
        });

        Schema::table('searches', function (Blueprint $table) {
            $table->dropColumn(['training_law_firm_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('law_firm_band_search');

        Schema::table('searches', function (Blueprint $table) {
            $table->integer('training_law_firm_id')->nullable()->default(null);
        });
    }
}
