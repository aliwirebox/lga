<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLawFirmsTableAddIsOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('law_firms', function (Blueprint $table) {
            $table->boolean('is_option');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('law_firms', function (Blueprint $table) {
            $table->dropColumn([
                                   'is_option',
                               ]);
        });
    }
}
