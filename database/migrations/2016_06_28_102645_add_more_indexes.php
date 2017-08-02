<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_department', function (Blueprint $table) {
            $table->primary(['candidate_id', 'training_seat_id']);
        });

        Schema::table('candidate_language', function (Blueprint $table) {
            $table->primary(['candidate_id', 'language_id']);
        });

        Schema::table('candidate_law_firm_band', function (Blueprint $table) {
            $table->primary(['candidate_id', 'law_firm_band_id']);
        });

        Schema::table('candidate_search', function (Blueprint $table) {
            $table->primary(['candidate_id', 'search_id']);
        });

        Schema::table('language_search', function (Blueprint $table) {
            $table->primary(['language_id', 'search_id']);
        });

        Schema::table('law_firm_band_search', function (Blueprint $table) {
            $table->primary(['law_firm_band_id', 'search_id']);
        });

        Schema::table('search_training_seat', function (Blueprint $table) {
            $table->primary(['search_id', 'training_seat_id']);
        });

        Schema::table('search_university_band', function (Blueprint $table) {
            $table->primary(['search_id', 'university_band_id']);
        });

        Schema::table('university_university_band', function (Blueprint $table) {
            $table->primary(['university_id', 'university_band_id'], 'uni_uni_band_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_department', function (Blueprint $table) {
            $table->dropPrimary('candidate_department_candidate_id_training_seat_id_primary');
        });

        Schema::table('candidate_language', function (Blueprint $table) {
            $table->dropPrimary('candidate_language_candidate_id_language_id_primary');
        });

        Schema::table('candidate_law_firm_band', function (Blueprint $table) {
            $table->dropPrimary('candidate_law_firm_band_candidate_id_law_firm_band_id_primary');
        });

        Schema::table('candidate_search', function (Blueprint $table) {
            $table->dropPrimary('candidate_search_candidate_id_search_id_primary');
        });

        Schema::table('language_search', function (Blueprint $table) {
            $table->dropPrimary('language_search_language_id_search_id_primary');
        });

        Schema::table('law_firm_band_search', function (Blueprint $table) {
            $table->dropPrimary('law_firm_band_search_law_firm_band_id_search_id_primary');
        });

        Schema::table('search_training_seat', function (Blueprint $table) {
            $table->dropPrimary('search_training_seat_search_id_training_seat_id_primary');
        });

        Schema::table('search_university_band', function (Blueprint $table) {
            $table->dropPrimary('search_university_band_search_id_university_band_id_primary');
        });

        Schema::table('university_university_band', function (Blueprint $table) {
            $table->dropPrimary('uni_uni_band_primary');
        });
    }
}
