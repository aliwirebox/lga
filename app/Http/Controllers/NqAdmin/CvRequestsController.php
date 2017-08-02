<?php

namespace App\Http\Controllers\NqAdmin;

use App\Models\NqAdminMatchQuery;
use Datatables;

class CvRequestsController extends BaseController
{
    public function index()
    {
        $this->logInfo("views cv requests");

        return view('app.nq-admin.cv-requests');
    }

    public function anyData()
    {
        $candidateList = NqAdminMatchQuery::getCvRequestedMatches()
            ->get()
            ->map('transformNqMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} cv request records");

        return Datatables::of($candidateList)->make(true);
    }
}

