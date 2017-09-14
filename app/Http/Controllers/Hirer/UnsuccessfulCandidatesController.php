<?php

namespace App\Http\Controllers\Hirer;

use App\Models\HirerMatchQuery;
use Yajra\Datatables\Datatables;

class UnsuccessfulCandidatesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views unsuccessful candidates");

        return view('app.hirer.unsuccessful-candidates');
    }

    public function anyData()
    {
        $hirer = getCurrentUser();

        $candidateList = HirerMatchQuery::getUnsuccessfulMatchesByLawFirm($hirer->law_firm_id)
            ->get()
            ->map('transformHirerMatchForLiveCandidatetable');

        $this->logInfo("requets {$candidateList->count()} unsuccessful candidate records");

        return Datatables::of($candidateList)->make(true);
    }
}
