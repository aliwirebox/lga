<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLawFirmBandsTableAddRank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('law_firm_bands', function (Blueprint $table) {
            $table->integer('rank')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('law_firm_bands', function (Blueprint $table) {
            $table->dropColumn([
                                   'rank',
                               ]);
        });
    }
}
