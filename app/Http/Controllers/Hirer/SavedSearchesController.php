<?php

namespace App\Http\Controllers\Hirer;

use App\Http\Controllers\Hirer\BaseController;
use Datatables;

class SavedSearchesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views saved searches");

        return view('app.hirer.search.savedsearches');
    }

    public function anyData()
    {
        $searchList = getCurrentUser()
            ->lawFirmSearches()
            ->active()
            ->with('vacancyDepartment', 'vacancyLocation', 'hirer')
            ->orderBy('searches.created_at', 'desc')
            ->get();

        $this->logInfo("requests {$searchList->count()} saved search records");

        return Datatables::of($searchList)
            ->editColumn('hirer_name', function ($search) {
                return $search->hirer->getFullName();
            })
            ->editColumn('vacancy_department_name', function ($search) {
                return $search->vacancyDepartment->name;
            })
            ->editColumn('vacancy_location_name', function ($search) {
                return $search->vacancyLocation->name;
            })
            ->editColumn('created_at_sort', function ($search) {
                return $search->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('created_at', function ($search) {
                return $search->created_at->format('d/m/Y');
            })
            ->editColumn('vacancy_salary_text', function ($search) {
                return $search->vacancy_salary_text;
            })
            ->editColumn('unviewed_matches_count', function ($search) {
                return getUnviewedMatchesCount($search->unviewed_matches_count);
            })
            ->editColumn('actions', function ($search) {
                $viewButton = sprintf('<a href="%s" class="btn btn-success btn-rounded btn-xs btn-block">View Matches</a>', route('hirer.search.results', $search->id));
                $editButton = sprintf('<a href="%s" class="btn btn-success btn-rounded btn-xs btn-block">Edit Search</a>', route('hirer.search.candidatefilters.edit', $search->id));
                $deleteButton = sprintf('<a href="%s" class="btn btn-warning btn-rounded btn-xs btn-block">Delete Search</a>', route('hirer.search.delete', $search->id));

                return $viewButton . $editButton . $deleteButton;
            })
            ->make(true);
    }
}
