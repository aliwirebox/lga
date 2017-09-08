<?php

namespace Quarx\Modules\Blogs\Requests;

use Auth;
use App\Http\Requests\Request;
use Quarx\Modules\Blogs\Models\Blog;

class BlogRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guard('brand_admins')->user()) {
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

        $rules = [
            'categories' => ['required', 'exists:blog_categories,id'],
            'image' => ['required', 'exists:images,id'],
        ];

        return array_merge(Blog::$rules, $rules);
    }
}
