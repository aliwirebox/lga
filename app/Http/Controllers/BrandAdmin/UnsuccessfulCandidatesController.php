<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\BrandAdminMatchQuery;
use Yajra\Datatables\Datatables;

class UnsuccessfulCandidatesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views unsuccessful candidates");

        $statusOptions = [
            config('match.offer'),
            config('match.second-interview'),
            config('match.first-interview'),
            config('match.cv-sent'),
        ];

        return view('app.brand-admin.unsuccessful-candidates', compact('statusOptions'));
    }

    public function anyData()
    {
        $candidateList = BrandAdminMatchQuery::getUnsuccessfulMatches()
            ->get()
            ->map('transformBrandMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} unsuccessful candidate records");

        return Datatables::of($candidateList)->make(true);
    }
}
