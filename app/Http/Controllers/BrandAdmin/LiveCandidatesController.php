<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\BrandAdminMatchQuery;
use Datatables;
use Log;

class LiveCandidatesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views live candidates");

        $statusOptions = [
            config('match.unsuccessful'),
            config('match.offer'),
            config('match.second-interview'),
            config('match.first-interview'),
        ];

        return view('app.brand-admin.live-candidates', compact('statusOptions'));
    }

    public function anyData()
    {
        $candidateList = BrandAdminMatchQuery::getLiveCandidatesMatches()
            ->get()
            ->map('transformBrandMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} live candidate records");

        return Datatables::of($candidateList)->make(true);
    }
}
