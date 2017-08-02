<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NqAdminSearchStatusUpdateRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $statuses = getCsvConfigKeys('match.statuses');

        return [
            'status' => 'required|in:' . $statuses,
            'candidate_id' => 'required'
        ];
    }
}
