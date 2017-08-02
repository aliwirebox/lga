<?php

namespace App\Http\Controllers\NqAdmin;

use App\Models\NqAdminMatchQuery;
use Datatables;

class DashboardController extends BaseController
{
    public function index()
    {
        $liveCandidateList = NqAdminMatchQuery::getLiveCandidatesMatches()
            ->take(5)
            ->get()
            ->map('transformNqMatchForDatatable');

        $cvRequestList = NqAdminMatchQuery::getCvRequestedMatches()
            ->take(3)
            ->get()
            ->map('transformNqMatchForDatatable');

        $cvProcessingList = NqAdminMatchQuery::getCvPendingMatches()
            ->take(3)
            ->get()
            ->map('transformNqMatchForDatatable');

        $this->logInfo("views dashboard");

        return view('app.nq-admin.dashboard.index', compact('liveCandidateList', 'cvRequestList', 'cvProcessingList'));
    }
}
