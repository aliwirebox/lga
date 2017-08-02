<?php

use Illuminate\Database\Seeder;

use  Quarx\Modules\Blogcategories\Models\Blogcategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCategory::truncate();

        factory(BlogCategory::class, 5)->create();
    }
}
