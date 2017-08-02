<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Controllers\Hirer\BaseController;
use App\Models\HirerMatchQuery;

class DashboardController extends BaseController
{
    public function index()
    {
        $hirer = getCurrentUser();

        $searchList = $hirer->lawFirmSearches()
            ->with([
                'vacancyLocation',
                'vacancyDepartment',
                'hirer'
            ])
            ->active()
            ->orderBy('unviewed_matches_count', 'desc')
            ->take(5)->get();

        $liveCandidateList = HirerMatchQuery::getLiveMatchesByLawFirm($hirer->law_firm_id)
            ->take(3)
            ->get()
            ->map('transformHirerMatchForDatatable');

        $cvRequestedList = HirerMatchQuery::getCvRequestedMatchesByLawFirm($hirer->law_firm_id)
            ->take(3)
            ->get()
            ->map('transformHirerMatchForDatatable');

        $this->logInfo("views dashboard");

        return view('app.hirer.dashboard.index', compact('searchList', 'liveCandidateList', 'cvRequestedList'));
    }
}
