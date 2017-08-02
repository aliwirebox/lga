<?php

namespace App\Http\Controllers\Hirer;

use App\Models\HirerMatchQuery;
use Yajra\Datatables\Facades\Datatables;

class CvRequestsController extends BaseController
{
    public function index()
    {
        $this->logInfo("views CV requests");

        return view('app.hirer.cv-requests');
    }

    public function anyData()
    {
        $hirer = getCurrentUser();

        $candidateList = HirerMatchQuery::getCvRequestedMatchesByLawFirm($hirer->law_firm_id)
            ->get()
            ->map('transformHirerMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} CV requests records");

        return Datatables::of($candidateList)->make(true);
    }
}
