<?php

namespace App\Http\Controllers\NqAdmin;

use App\Models\NqAdminMatchQuery;
use Datatables;
use Log;

class LiveCandidatesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views live candidates");

        $statusOptions = [
            config('match.offer'),
            config('match.second-interview'),
            config('match.first-interview'),
        ];

        return view('app.nq-admin.live-candidates', compact('statusOptions'));
    }

    public function anyData()
    {
        $candidateList = NqAdminMatchQuery::getLiveCandidatesMatches()
            ->get()
            ->map('transformNqMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} live candidate records");

        return Datatables::of($candidateList)->make(true);
    }
}
