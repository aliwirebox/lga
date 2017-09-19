<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Http\Requests\BrandAdminCreateLawFirmRequest;
use App\Http\Requests\BrandAdminEditLawFirmRequest;
use App\Models\LawFirm;
use Yajra\Datatables\Datatables;

class LawFirmsController extends BaseController
{
    public function index()
    {
        return view('app.brand-admin.law-firms');
    }

    public function anyData()
    {
        $lawFirmList = LawFirm::with('domains')
            ->withCount('hirers')
            ->get()
            ->map(function ($firm) {
                return [
                    'id'           => $firm->id,
                    'name'         => $firm->name,
                    'domains'      => $firm->domains->implode('name', ', '),
                    'hirers_count' => $firm->hirers_count,
                ];
            });

        $this->logInfo("requests {$lawFirmList->count()} law firm database records");

        return Datatables::of($lawFirmList)
            ->editColumn('actions', function ($lawFirm) {
                $editButton = sprintf('<a href="%s" class="btn btn-success btn-rounded btn-xs btn-block">Edit</a>', route('brand-admin.law-firms.edit', $lawFirm['id']));
                $deleteButton = sprintf('<a href="%s" class="btn btn-warning btn-rounded btn-xs btn-block">Delete</a>', route('brand-admin.law-firms.edit', $lawFirm['id']));

                return $editButton . $deleteButton;
            })
            ->make(true);
    }

    public function create()
    {
        $lawFirm = new LawFirm();

        return view('app.brand-admin.law-firms-create', compact('lawFirm'));
    }

    public function store(BrandAdminCreateLawFirmRequest $request)
    {
        $lawFirm = LawFirm::create($request->only(['name']));

        $input = $request->getDomains();

        if ($input) {
            $lawFirm->domains()->createMany($input);
        }

        return redirect()
            ->route('brand-admin.law-firms')
            ->with('message', 'Law firm created');
    }

    public function edit(LawFirm $lawFirm)
    {
        return view('app.brand-admin.law-firms-edit', compact('lawFirm'));
    }

    public function update(BrandAdminEditLawFirmRequest $request, LawFirm $lawFirm)
    {
        $lawFirm->fill($request->only(['name']))->save();

        $lawFirm->domains()->delete();

        $input = $request->getDomains();

        if ($input) {
            $lawFirm->domains()->createMany($input);
        }

        return redirect()
            ->route('brand-admin.law-firms')
            ->with('message', 'Law firm updated');
    }
}
