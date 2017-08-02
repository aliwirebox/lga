<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRankAndOrderToUniversityBands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('university_bands', function (Blueprint $table) {
            $table->integer('order')->default(0);
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
        Schema::table('university_bands', function (Blueprint $table) {
            $table->dropColumn([
                'order',
                'rank',
            ]);
        });
    }
}
