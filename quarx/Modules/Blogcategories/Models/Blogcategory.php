<?php

namespace Quarx\Modules\Blogcategories\Models;

use Yab\Quarx\Models\QuarxModel;
use  Quarx\Modules\Blogs\Models\Blog;


class Blogcategory extends QuarxModel
{
    public $table = "blog_categories";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "name",
        'url',
    ];

    public static $rules = [
        'name' => 'required|string',
        'url' => 'required|string',
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_blog_category');
    }

}
