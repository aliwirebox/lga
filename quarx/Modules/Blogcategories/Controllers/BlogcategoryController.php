<?php

namespace Quarx\Modules\Blogcategories\Controllers;

use Quarx;
use CryptoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Blogcategories\Services\BlogcategoryService;
use Quarx\Modules\Blogcategories\Requests\BlogcategoryRequest;

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
        return view('blogcategories::blogcategories.index')
            ->with('pagination', $blogcategories->render())
            ->with('blogcategories', $blogcategories);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $blogcategories = $this->service->search($request->search);
        return view('blogcategories::blogcategories.index')
            ->with('term', $request->search)
            ->with('pagination', $blogcategories->render())
            ->with('blogcategories', $blogcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogcategories::blogcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BlogcategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogcategoryRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            Quarx::notification('Successfully created', 'success');
            return redirect('quarx/blogcategories/'.$result->id.'/edit');
        }

        Quarx::notification('Failed to create', 'warning');
        return redirect('quarx/blogcategories');
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
        return view('blogcategories::blogcategories.show')->with('blogcategory', $blogcategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogcategory = $this->service->find($id);
        return view('blogcategories::blogcategories.edit')->with('blogcategory', $blogcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BlogcategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogcategoryRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except(['_token', '_method']));

        if ($result) {
            Quarx::notification('Successfully updated', 'success');
            return back();
        }

        Quarx::notification('Failed to update', 'warning');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            Quarx::notification('Successfully deleted', 'success');
            return redirect('quarx/blogcategories');
        }

        Quarx::notification('Failed to delete', 'warning');
        return redirect('quarx/blogcategories');
    }
}
