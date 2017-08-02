<?php

namespace Quarx\Modules\Blogcategories\Requests;

use Auth;
use App\Http\Requests\Request;
use Quarx\Modules\Blogcategories\Models\Blogcategory;

class BlogcategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guard('nq_admins')->user()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Blogcategory::$rules;
    }
}
