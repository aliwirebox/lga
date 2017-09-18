<?php

namespace App\Http\Controllers\BrandAdmin;

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
        $lawFirmList = LawFirm::all()
            ->map(function ($firm) {
                return [
                    'id' => $firm->id,
                    'name' => $firm->name,
                ];
            });

        $this->logInfo("requests {$lawFirmList->count()} law firm database records");

        return Datatables::of($lawFirmList)->make(true);
    }
}
