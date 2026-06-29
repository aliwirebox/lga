<?php

use Illuminate\Database\Seeder;

use Quarx\Modules\Blogs\Models\Blog;
use Quarx\Modules\Blogcategories\Models\Blogcategory;
use App\Models\Quarx\Image;
    
class BlogPostsSeeder extends Seeder
{
    protected $categoryList;
    protected $imageList;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->loadManyToManyRelationships();
                        
        factory(Blog::class, 40)->create()->each(
            function ($blog) {
                $this->setManyToManyRelationships($blog); 
            }
        );
    }
    
    protected function setManyToManyRelationships($blog)
    {
        $numberOfCategories = random_int(2, 3);

        $categoryIdList = $this->categoryList->random($numberOfCategories)->pluck('id')->toArray();

        $image = $this->imageList->random();
        
        $blog->image()->associate($image);
        $blog->save();

        $blog->categories()->attach($categoryIdList);
    }
    
    protected function loadManyToManyRelationships()
    {
        $this->categoryList = BlogCategory::all();
        $this->imageList = Images::all();
    }

    protected function truncateTables()
    {
        Blog::truncate();
        DB::table('blog_blog_category')->truncate();
    }
}
