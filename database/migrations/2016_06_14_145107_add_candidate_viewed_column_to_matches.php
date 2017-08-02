<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCandidateViewedColumnToMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_search', function (Blueprint $table) {
            $table->renameColumn('has_been_viewed', 'hirer_viewed');
            $table->boolean('candidate_viewed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_search', function (Blueprint $table) {
            $table->renameColumn('hirer_viewed', 'has_been_viewed');
            $table->dropColumn(['candidate_viewed']);
        });
    }
}
