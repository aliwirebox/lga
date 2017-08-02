<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('candidate_location', function (Blueprint $table) {
            $table->integer('candidate_id')->unsigned()->index();
            $table->integer('location_id')->unsigned()->index();
            $table->primary(['candidate_id', 'location_id']);
        });

        Schema::create('law_firm_band_location', function (Blueprint $table) {
            $table->integer('law_firm_band_id')->unsigned()->index();
            $table->integer('location_id')->unsigned()->index();
            $table->primary(['location_id', 'law_firm_band_id']);
        });

        Schema::table('searches', function (Blueprint $table) {
            $table->integer('vacancy_location_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('candidate_location');
        Schema::drop('locations');
        Schema::drop('law_firm_band_location');

        Schema::table('searches', function (Blueprint $table) {
            $table->dropColumn('vacancy_location_id');
        });
    }
}
