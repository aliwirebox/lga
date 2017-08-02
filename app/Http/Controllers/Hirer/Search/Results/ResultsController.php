<?php

namespace App\Http\Controllers\Hirer\Search\Results;

use App\Http\Controllers\Hirer\Search\BaseSearchController;
use App\Models\HirerMatchQuery;
use App\Models\Language;
use App\Models\LawFirmBand;
use App\Models\TrainingSeat;
use App\Models\UniversityBand;
use Illuminate\Http\Request;
use App\Models\Search;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class ResultsController extends BaseSearchController
{
    public function index(Request $request)
    {
        $session = $request->session()->get('search');

        if (!$session) {
            abort(403, 'Search session not set.');
        }

        $search = $this->createSearch($session);

        $request->session()->forget('search');

        $matchesRoute = route('hirer.search.results.data', $search->id);
        $requestCvRoute = route('hirer.search.results.request', $search->id);
        $viewedMatchRoute = route('hirer.search.results.viewed', $search->id);

        return view('app.hirer.search.results', compact('search', 'matchesRoute', 'requestCvRoute', 'viewedMatchRoute'));
    }
}
