<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueEmailColumnForCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function ($table) {
            $table->dropUnique('candidates_email_unique');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Dont put the index back because migrations fail if duplicate addresses have been added
        /*
        Schema::table('candidates', function ($table) {
            $table->dropIndex('candidates_email_index');
            $table->unique('email');
        });
         */
    }
}
