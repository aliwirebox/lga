<?php

namespace Quarx\Modules\Blogs\Controllers;

use Quarx;
use CryptoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quarx\Modules\Blogs\Services\BlogService;
use Quarx\Modules\Blogs\Requests\BlogRequest;
use Quarx\Modules\Blogcategories\Models\Blogcategory;
use Yab\Quarx\Models\Images;



class BlogController extends Controller
{
    public function __construct(BlogService $blogService)
    {
        $this->service = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = $this->service->paginated();
        return view('blogs::blogs.index')
            ->with('pagination', $blogs->render())
            ->with('blogs', $blogs);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $blogs = $this->service->search($request->search);
        return view('blogs::blogs.index')
            ->with('term', $request->search)
            ->with('pagination', $blogs->render())
            ->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategories = BlogCategory::all();
        $images = Images::all();
        $blogCategoriesArray = [];
        
        return view('blogs::blogs.create')->with(['blogCategories' => $blogCategories, 'blogCategoriesArray' => $blogCategoriesArray, 'images' => $images]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            Quarx::notification('Successfully created', 'success');
            return redirect('quarx/blogs/'.$result->id.'/edit');
        }

        Quarx::notification('Failed to create', 'warning');
        return redirect('quarx/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = $this->service->find($id);
        return view('blogs::blogs.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = $this->service->find($id);
        $blogCategories = BlogCategory::all();
        $images = Images::all();
        $blogCatSelected = $blog->categories;
        
        $blogCategoriesArray = [];
        foreach ($blogCatSelected as $key => $value) {
            array_push($blogCategoriesArray, $value->id);
        }
                
        return view('blogs::blogs.edit')->with(['blog' => $blog, 'blogCategories' => $blogCategories, 'blogCategoriesArray' => $blogCategoriesArray, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\BlogRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
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
            return redirect('quarx/blogs');
        }

        Quarx::notification('Failed to delete', 'warning');
        return redirect('quarx/blogs');
    }
}
