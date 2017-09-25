<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToLawFirmsTableAndHirersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hirers', function ($table) {
            $table->softDeletes();
        });

        Schema::table('law_firms', function ($table) {
            $table->softDeletes();
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
            $table->dropColumn(['deleted_at']);
        });

        Schema::table('law_firms', function ($table) {
            $table->dropColumn(['deleted_at']);
        });
    }
}
