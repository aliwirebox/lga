<?php

namespace App\Http\Controllers\Hirer\Search\Delete;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Models\Search;

class DeleteController extends BaseSearchController
{
    public function post($id)
    {
        $search = Search::findOrFail($id);

        $this->authorize('view-update-search', $search);

        $search->name = '';

        $search->save();

        return redirect()->back()->with(['success' => 'Search deleted']);
    }
}