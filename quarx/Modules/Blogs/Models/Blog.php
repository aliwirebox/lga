<?php

namespace Quarx\Modules\Blogs\Models;

use App\Models\Quarx\QuarxModel;
use Quarx\Modules\Blogcategories\Models\Blogcategory;
use App\Models\Quarx\Image;


class Blog extends QuarxModel
{
    public $table = "blogs";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "title",
        "tags",
        "entry",
        "template",
        "is_published",
        "published_at",
        "seo_description",
        "seo_keywords",
        "author",
        "url"
    ];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required|string',
    ];
    
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category');
    }
    public function image()
    {
        return $this->belongsTo(Images::class);
    }
}

