<?php

namespace App\Http\Controllers\BrandAdmin;

use App\Models\Candidate;
use Auth;
use Datatables;

class CandidatesController extends BaseController
{
    public function index()
    {
        $this->logInfo("views candidates database");

        return view('app.brand-admin.candidates');
    }

    public function toggleLiveStatus($id)
    {
        $candidate = Candidate::findOrFail($id);

        $this->logInfo("Toggle candidates live status {$candidate->email}");

        if ($candidate->is_live) {
            $candidate->is_live = false;
        } else {
            $candidate->is_live = true;
        }

        $candidate->save();

        return redirect(route('brand-admin.candidates'));
    }

    public function anyData()
    {
        $candidateList = Candidate::withTrashed()
            ->get()
            ->map(function ($candidate) {
                $data = $candidate->toArray();

                $data['name'] = $candidate->getFullName();
                $data['email'] = linkEmail($candidate->email);
                $data['reference'] = $candidate->reference;
                $data['deleted_at'] = convertDateIfCarbon('d/m/Y', $candidate->deleted_at);
                $data['deleted_at_sort'] = convertDateIfCarbon('Y-m-d H:i:s', $candidate->deleted_at);
                $data['created_at'] = $candidate->created_at->format("d/m/Y");
                $data['created_at_sort'] = $candidate->created_at->format('Y-m-d H:i:s');
                $data['updated_at'] = $candidate->updated_at->format("d/m/Y");
                $data['updated_at_sort'] = $candidate->updated_at->format('Y-m-d H:i:s');
                $data['is_live'] = boolToText($candidate->is_live);
                $data['email_verified'] = boolToText($candidate->email_verified);
                $data['match_candidate_cv_download'] = getCvDownloadButtonOrUnavailable($candidate);

                return $data;
            });

        $this->logInfo("requests {$candidateList->count()} candidates database records");

        return Datatables::of($candidateList)->make(true);
    }

    public function login($id)
    {
        $admin = getCurrentUser();
        $candidate = Candidate::findOrFail($id);

        $this->logInfo("logins in as candidate {$candidate->email}");

        Auth::guard('brand_admins')->logout();
        Auth::guard('candidates')->login($candidate);

        session(['acting.brand_admin.email' => $admin->email]);
        setGuard('candidates');

        return redirect(getUserHomeRoute());
    }

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);

        $candidate->delete();

        $this->logInfo("deletes candidate {$candidate->email}");

        sendEmailDeletedCandidate($candidate);

        return response()->json(['message' => 'OK']);
    }
}
