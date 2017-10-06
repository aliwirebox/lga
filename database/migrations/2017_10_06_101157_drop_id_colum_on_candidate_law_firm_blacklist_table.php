<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIdColumOnCandidateLawFirmBlacklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_law_firm_blacklist', function (Blueprint $table) {
            $table->dropColumn(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_law_firm_blacklist', function (Blueprint $table) {
            $table->increments('id');
        });
    }
}
