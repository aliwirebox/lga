<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUniqueEmailIndexFromHirersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hirers', function (Blueprint $table) {
            $table->dropUnique('hirers_email_unique');
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
        Schema::table('hirers', function (Blueprint $table) {
            $table->dropIndex('hirers_email_index');
            $table->unique('email');
        });
         */
    }
}
