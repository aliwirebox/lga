<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHirerTermsFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hirers', function (Blueprint $table) {
            $table->boolean('agreed_terms')->default(0);
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
            $table->dropColumn([
                'agreed_terms',
            ]);
        });
    }
}
