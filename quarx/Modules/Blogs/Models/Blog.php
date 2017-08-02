<?php

namespace Quarx\Modules\Blogs\Models;

use Yab\Quarx\Models\QuarxModel;
use Quarx\Modules\Blogcategories\Models\Blogcategory;
use Yab\Quarx\Models\Images;


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

