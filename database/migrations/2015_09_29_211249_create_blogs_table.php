<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('author');
            $table->text('entry')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_published')->default(0);
            $table->string('url');
            $table->timestamp('published_at')->default("2016-05-10 15:30:30");
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }

}
