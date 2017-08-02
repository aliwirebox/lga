<?php

namespace App\Http\Controllers\Hirer\Search\Save;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Http\Requests\HirerSaveSearchRequest;
use App\Models\LawFirmBand;
use App\Models\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaveController extends BaseSearchController
{
    public function save(HirerSaveSearchRequest $request)
    {
        $input = $request->all();
        $search = Search::findOrFail($input['id']);

        $this->authorize('view-update-search', $search);

        $search->name = $input['name'];

        $search->save();

        return response()->json($search);
    }
}