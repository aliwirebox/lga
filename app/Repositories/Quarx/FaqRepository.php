<?php

namespace App\Repositories\Quarx;

use App\Models\Quarx\Faq;
use Carbon\Carbon;

class FaqRepository
{
    public function all()
    {
        return Faq::orderBy('created_at', 'desc')->get();
    }

    public function published()
    {
        return Faq::where('is_published', 1)
            ->where('published_at', '<=', Carbon::now()->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'desc')
            ->paginate(25);
    }

    public function findFaqById($id)
    {
        return Faq::find($id);
    }

    public function store($input)
    {
        $input['is_published'] = isset($input['is_published']) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = isset($input['published_at']) ? $input['published_at'] : Carbon::now()->format('Y-m-d H:i:s');

        return Faq::create($input);
    }

    public function update($faq, $input)
    {
        $input['is_published'] = isset($input['is_published']) ? (bool) $input['is_published'] : 0;
        $input['published_at'] = isset($input['published_at']) ? $input['published_at'] : Carbon::now()->format('Y-m-d H:i:s');
        $faq->fill($input);
        $faq->save();

        return $faq;
    }
}
