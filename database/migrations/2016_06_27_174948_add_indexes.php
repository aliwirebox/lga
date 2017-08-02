<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_training_seat', function (Blueprint $table) {
            $table->primary(['candidate_id', 'training_seat_id']);
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->index('training_law_firm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_training_seat', function (Blueprint $table) {
            $table->dropPrimary('candidate_training_seat_candidate_id_training_seat_id_primary');
        });

        Schema::table('candidates', function (Blueprint $table) {
            $table->dropIndex(['training_law_firm_id']);
        });
    }
}
