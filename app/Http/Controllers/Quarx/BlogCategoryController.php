<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;

use Quarx\Modules\Blogcategories\Services\BlogcategoryService;
use Quarx\Modules\Blogcategories\Models\Blogcategory;

class BlogCategoryController extends Controller
{

    /** @var  BlogcategoryRepository */
    private $blogcategoryRepository;

    function __construct(BlogcategoryService $blogcategoryRepo)
    {        
        $this->blogcategoryRepository = $blogcategoryRepo;
    }


    /**
     * Display Blogs By Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($url)
    {

        $blogs = $this->blogcategoryRepository->findBlogsByCategoryURL($url);
        $blogcategories = Blogcategory::all();

        if (empty($blogs)) abort(404);

        return view('quarx-frontend::blog.all2')
            ->with([
                'blogs' => $blogs,
                'blogcategories' => $blogcategories,
                'count' => $blogs->count(),
                'currentrow' => 1,
            ]);
    }
}
