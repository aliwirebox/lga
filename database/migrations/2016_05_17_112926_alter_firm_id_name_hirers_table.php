<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFirmIdNameHirersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hirers', function ($table) {
            $table->renameColumn('firm_id', 'law_firm_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hirers', function ($table) {
            $table->renameColumn('law_firm_id', 'firm_id');
        });
    }
}
