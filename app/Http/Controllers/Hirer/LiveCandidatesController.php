<?php

namespace App\Http\Controllers\Hirer;

use App\Models\HirerMatchQuery;
use Yajra\DataTables\Facades\DataTables;

class LiveCandidatesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views live candidates");
        
        return view('app.hirer.live-candidates');
    }

    public function anyData()
    {
        $hirer = getCurrentUser();

        $candidateList = HirerMatchQuery::getLiveMatchesByLawFirm($hirer->law_firm_id)
            ->get()
            ->map('transformHirerMatchForLiveCandidatetable');

        $this->logInfo("requets {$candidateList->count()} live candidate records");

        return Datatables::of($candidateList)->make(true);
    }
}
