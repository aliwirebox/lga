<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerificationEmailSentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hirers', function ($table) {
            $table->boolean('email_sent')->default(false);
        });

        Schema::table('candidates', function ($table) {
            $table->boolean('email_sent')->default(false);
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
            $table->dropColumn(['email_sent']);
        });

        Schema::table('candidates', function ($table) {
            $table->dropColumn(['email_sent']);
        });
    }
}
