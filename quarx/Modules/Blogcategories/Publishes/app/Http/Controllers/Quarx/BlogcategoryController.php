<?php

namespace App\Http\Controllers\Quarx;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Blogcategories\Services\BlogcategoryService;

class BlogcategoryController extends Controller
{
    public function __construct(BlogcategoryService $blogcategoryService)
    {
        $this->service = $blogcategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogcategories = $this->service->paginated();
        return view('quarx-frontend::blogcategories.all')->with('blogcategories', $blogcategories);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogcategory = $this->service->find($id);
        return view('quarx-frontend::blogcategories.show')->with('blogcategory', $blogcategory);
    }
}
