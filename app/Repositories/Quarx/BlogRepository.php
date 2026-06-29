<?php

namespace App\Repositories\Quarx;

use App\Models\Quarx\Blog;
use Carbon\Carbon;

class BlogRepository
{
    public function all()
    {
        return Blog::orderBy('created_at', 'desc')->get();
    }

    public function publishedAndPaginated()
    {
        return Blog::orderBy('created_at', 'desc')
            ->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->paginate(25);
    }

    public function published()
    {
        return Blog::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    }

    public function tags($tag)
    {
        return Blog::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('tags', 'LIKE', '%'.$tag.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    }

    public function allTags()
    {
        $tags = [];
        $blogs = Blog::orderBy('created_at', 'desc')->get();

        foreach ($blogs as $blog) {
            foreach (explode(',', $blog->tags) as $tag) {
                array_push($tags, $tag);
            }
        }

        return array_unique($tags);
    }

    public function findBlogsByURL($url)
    {
        return Blog::where('url', $url)
            ->where('is_published', 1)
            ->first();
    }

    public function findBlogsByTag($tag)
    {
        return Blog::where('tags', 'LIKE', "%$tag%")
            ->where('is_published', 1)
            ->get();
    }

    public function findBlogById($id)
    {
        return Blog::find($id);
    }

    public function store($input)
    {
        $input['url'] = $this->convertToURL($input['url']);
        $input['is_published'] = isset($input['is_published']) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = isset($input['published_at']) ? $input['published_at'] : Carbon::now()->format('Y-m-d H:i:s');

        return Blog::create($input);
    }

    public function update($blog, $input)
    {
        $input['url'] = $this->convertToURL($input['url']);
        $input['is_published'] = isset($input['is_published']) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = isset($input['published_at']) ? $input['published_at'] : Carbon::now()->format('Y-m-d H:i:s');
        $blog->fill($input);
        $blog->save();

        return $blog;
    }

    protected function convertToURL($string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($string)));
    }
}
