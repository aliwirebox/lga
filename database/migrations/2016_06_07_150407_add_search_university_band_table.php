<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSearchUniversityBandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_university_band', function (Blueprint $table) {
            $table->integer('search_id');
            $table->integer('university_band_id');
            $table->timestamps();
        });

        Schema::table('searches', function (Blueprint $table) {
            $table->dropColumn(['university_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_university_band');

        Schema::table('searches', function (Blueprint $table) {
            $table->integer('university_id')->nullable()->default(null);
        });
    }
}
