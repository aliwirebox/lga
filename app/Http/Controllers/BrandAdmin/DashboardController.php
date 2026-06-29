<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\BrandAdminMatchQuery;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends BaseController
{
    public function index()
    {
        $liveCandidateList = BrandAdminMatchQuery::getLiveCandidatesMatches()
            ->take(5)
            ->get()
            ->map('transformBrandMatchForDatatable');

        $cvRequestList = BrandAdminMatchQuery::getCvRequestedMatches()
            ->take(3)
            ->get()
            ->map('transformBrandMatchForDatatable');

        $cvProcessingList = BrandAdminMatchQuery::getCvPendingMatches()
            ->take(3)
            ->get()
            ->map('transformBrandMatchForDatatable');

        $this->logInfo("views dashboard");

        return view('app.brand-admin.dashboard.index', compact('liveCandidateList', 'cvRequestList', 'cvProcessingList'));
    }
}
