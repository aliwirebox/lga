<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\BrandAdminMatchQuery;
use Datatables;

class CvRequestsController extends BaseController
{
    public function index()
    {
        $this->logInfo("views cv requests");

        return view('app.brand-admin.cv-requests');
    }

    public function anyData()
    {
        $candidateList = BrandAdminMatchQuery::getCvRequestedMatches()
            ->get()
            ->map('transformBrandMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} cv request records");

        return Datatables::of($candidateList)->make(true);
    }
}

