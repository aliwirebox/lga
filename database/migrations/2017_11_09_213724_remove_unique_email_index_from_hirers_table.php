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
        Schema::table('hirers', function (Blueprint $table) {
            $table->dropIndex('hirers_email_index');
            $table->unique('email');
        });
    }
}
