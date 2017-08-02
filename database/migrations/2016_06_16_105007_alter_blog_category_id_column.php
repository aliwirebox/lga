<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBlogCategoryIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_blog_category', function ($table) {
            $table->renameColumn('blog_category_id', 'blogcategory_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_blog_category', function ($table) {
            $table->renameColumn('blogcategory_id', 'blog_category_id');
        });
    }
}
