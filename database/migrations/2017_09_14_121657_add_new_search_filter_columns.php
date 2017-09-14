<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewSearchFilterColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('searches', function (Blueprint $table) {
            $table->boolean('travel_abroad')->default(0);
            $table->date('available_date');
            $table->boolean('position_permanent')->default(0);
            $table->boolean('has_degree')->default(0);
            $table->boolean('has_lpc')->default(0);
            $table->boolean('has_rtw')->default(0);
            $table->boolean('member_institute_paralegals')->default(0);
            $table->boolean('member_of_cilex')->default(0);
            $table->tinyInteger('years_experience')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('searches', function (Blueprint $table) {
            $table->dropColumn([
                'travel_abroad',
                'available_date',
                'position_permanent',
                'has_degree',
                'has_lpc',
                'has_rtw',
                'member_institute_paralegals',
                'member_of_cilex',
                'years_experience',
            ]);
        });
    }
}
