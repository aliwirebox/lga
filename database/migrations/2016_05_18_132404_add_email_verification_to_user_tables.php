<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailVerificationToUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hirers', function ($table) {
            $table->boolean('email_verified')->default(false);
            $table->string('email_token')->nullable()->default(null);
        });

        Schema::table('candidates', function ($table) {
            $table->boolean('email_verified')->default(false);
            $table->string('email_token')->nullable()->default(null);;
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
            $table->dropColumn(['email_verified', 'email_token']);
        });

        Schema::table('candidates', function ($table) {
            $table->dropColumn(['email_verified', 'email_token']);
        });
    }
}
