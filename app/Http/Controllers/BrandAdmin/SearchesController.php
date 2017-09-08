<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Http\Requests\BrandAdminSearchStatusUpdateRequest;
use App\Models\Candidate;
use App\Models\Search;

class SearchesController extends BaseController
{
    public function update(BrandAdminSearchStatusUpdateRequest $request, $id)
    {
        $search = Search::findOrFail($id);
        $candidate = Candidate::findOrFail($request->input('candidate_id'));

        if (!$search->matches->contains($candidate->id)) {
            $this->logInfo("tires to request {$candidate->email} cv but candidate isn't matched in search {$search->id}");
            abort(401);
        }

        $search->matches()->updateExistingPivot($candidate->id, $request->only('status'));

        $this->logInfo("updates {$candidate->email} to status {$request->input('status')} for search {$search->id}");

        sendEmailByMatchStatus($request->input('status'), $search, $candidate);

        return response()->json(['status' => 'OK']);
    }
}
