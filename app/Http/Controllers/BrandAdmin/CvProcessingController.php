<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\BrandAdminMatchQuery;
use App\Models\Candidate;
use Yajra\DataTables\Facades\DataTables;
use Storage;
use Log;

class CvProcessingController extends BaseController
{
    public function index()
    {
        $this->logInfo("views CV's processing");

        $statusOptions = [
            config('match.cv-sent'),
        ];

        return view('app.brand-admin.cv-processing', compact('statusOptions'));
    }

    public function anyData()
    {
        $candidateList = BrandAdminMatchQuery::getCvPendingMatches()
            ->get()
            ->map('transformBrandMatchForDatatable');

        $this->logInfo("requests {$candidateList->count()} CV processing records");

        return Datatables::of($candidateList)->make(true);
    }

    public function downloadCv($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        if (!Storage::disk('candidate-cvs')->exists($candidateId)) {
            abort(500, "Candidate {$candidate->email} CV is missing");
        }

        $path = getStorageFilePath('candidate-cvs', $candidateId);

        $this->logInfo("downloads candidate {$candidate->email} {$candidate->cv_name} CV ");

        return response()->download($path, $candidate->cv_name);
    }
}
