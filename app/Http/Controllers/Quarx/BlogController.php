<?php

namespace App\Http\Controllers\Quarx;

use App\Http\Controllers\Controller;

use Quarx\Modules\Blogs\Services\BlogService;
use Quarx\Modules\Blogcategories\Models\Blogcategory;

class BlogController extends Controller
{

    /** @var  BlogRepository */
    private $blogRepository;

    function __construct(BlogService $blogRepo)
    {        
        $this->blogRepository = $blogRepo;
    }

    /**
     * Display all Blog entries.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function all()
    {
        $blogs = $this->blogRepository->publishedAndPaginated();
        $blogcategories = Blogcategory::all();

        if (empty($blogs)) abort(404);

        return view('quarx-frontend::blog.all')
            ->with(['blogs'=> $blogs, 'blogcategories'=> $blogcategories ]);
    }

    /**
     * Display all Blog entries.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function tag($tag)
    {
        $blogs = $this->blogRepository->tags($tag);
        $blogcategories = Blogcategory::all();

        if (empty($blogs)) abort(404);

        return view('quarx-frontend::blog.all')
            ->with(['blogs'=> $blogs, 'blogcategories'=> $blogcategories ]);
    }

    /**
     * Display the specified Blog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($url)
    {
        $blog = $this->blogRepository->findBlogsByURL($url);
        $blogcategories = Blogcategory::all();

        if (empty($blog)) abort(404);

        return view('quarx-frontend::blog.'.$blog->template)
            ->with(['blog'=> $blog, 'blogcategories'=> $blogcategories ]);
    }
}
