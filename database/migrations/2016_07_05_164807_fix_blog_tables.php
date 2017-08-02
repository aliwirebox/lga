<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixBlogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('faqs', function(Blueprint $table) {
            $table->dropColumn(['published_at']);
        });

        Schema::table('faqs', function ($table) {
            $table->timestamp('published_at')->nullable();
        });

        Schema::table('blogs', function(Blueprint $table) {
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faqs', function(Blueprint $table) {
            $table->dropColumn(['published_at']);
        });

        Schema::table('faqs', function ($table) {
            $table->string('published_at');
        });

        Schema::table('blogs', function(Blueprint $table) {
            $table->dropColumn(['seo_description', 'seo_keywords']);
        });
    }
}
