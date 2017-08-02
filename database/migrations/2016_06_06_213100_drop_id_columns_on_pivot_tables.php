<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropIdColumnsOnPivotTables extends Migration
{
    protected $tableList = [
        'candidate_training_seat',
        'candidate_law_firm_band',
        'candidate_search',
        'language_search',
        'search_training_seat',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tableList as $tableName) {
            Schema::table($tableName, function ($table) {
                $table->dropColumn(['id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tableList as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->increments('id');
            });
        }
    }
}
