<?php

namespace App\Repositories\Quarx;

use App\Models\Quarx\Page;
use Carbon\Carbon;

class PagesRepository
{
    public function all()
    {
        return Page::all();
    }

    public function published()
    {
        return Page::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    }

    public function findPagesByURL($url)
    {
        return Page::where('url', $url)
            ->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->first();
    }

    public function findPagesById($id)
    {
        return Page::find($id);
    }

    public function store($input)
    {
        $input['url'] = $this->convertToURL($input['url']);
        $input['is_published'] = isset($input['is_published']) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = isset($input['published_at']) ? $input['published_at'] : Carbon::now()->format('Y-m-d H:i:s');

        return Page::create($input);
    }

    public function update($page, $input)
    {
        $input['url'] = $this->convertToURL($input['url']);
        $input['is_published'] = isset($input['is_published']) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = isset($input['published_at']) ? $input['published_at'] : Carbon::now()->format('Y-m-d H:i:s');
        $page->fill($input);
        $page->save();

        return $page;
    }

    protected function convertToURL($string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($string)));
    }
}
