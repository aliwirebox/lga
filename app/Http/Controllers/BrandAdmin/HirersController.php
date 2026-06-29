<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\Hirer;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class HirersController extends BaseController
{
    public function index()
    {
        $this->logInfo("views hirers database");

        return view('app.brand-admin.hirers');
    }

    public function anyData()
    {
        $hirerList = Hirer::with('lawFirm')->get()->map(function ($hirer) {
            $data = $hirer->toArray();
            $data['name'] = $hirer->getFullName();
            $data['email'] = linkEmail($hirer->email);
            $data['law_firm_name'] = $hirer->lawFirm->name;
            $data['created_at'] = $hirer->created_at->format("d/m/Y");
            $data['created_at_sort'] = $hirer->created_at->format('Y-m-d H:i:s');
            $data['updated_at'] = $hirer->updated_at->format("d/m/Y");
            $data['updated_at_sort'] = $hirer->updated_at->format('Y-m-d H:i:s');
            $data['email_verified'] = boolToText($hirer->email_verified);

            return $data;
        });

        $this->logInfo("requests {$hirerList->count()} hirers database records");

        return Datatables::of($hirerList)->make(true);
    }

    public function login($id)
    {
        $admin = getCurrentUser();
        $hirer = Hirer::findOrFail($id);

        $this->logInfo("logins in as hirer {$hirer->email}");

        Auth::guard('brand_admins')->logout();
        Auth::guard('hirers')->login($hirer);

        session(['acting.brand_admin.email' => $admin->email]);
        setGuard('hirers');

        return redirect(getUserHomeRoute());
    }
}
