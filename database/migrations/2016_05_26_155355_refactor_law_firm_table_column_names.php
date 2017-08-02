<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorLawFirmTableColumnNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('law_firm_bands_law_firms', 'law_firm_law_firm_band');
        Schema::table('law_firm_law_firm_band', function ($table) {
            $table->renameColumn('law_firms_id', 'law_firm_id');
            $table->renameColumn('law_firm_bands_id', 'law_firm_band_id');
        });
        Schema::table('law_firm_domains', function ($table) {
            $table->renameColumn('law_firms_id', 'law_firm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('law_firm_domains', function ($table) {
            $table->renameColumn('law_firm_id', 'law_firms_id');
        });
        Schema::table('law_firm_law_firm_band', function ($table) {
            $table->renameColumn('law_firm_id', 'law_firms_id');
            $table->renameColumn('law_firm_band_id', 'law_firm_bands_id');
        });
        Schema::rename('law_firm_law_firm_band', 'law_firm_bands_law_firms');
    }
}
