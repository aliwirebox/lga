<?php

namespace app\Http\ViewComposers;

use Illuminate\View\View;
use Yab\Quarx\Repositories\BlogRepository;

class BlogSidebarComposer
{
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;
    }

    public function compose(View $view)
    {
        $view->with('tags', $this->blogRepository->allTags());
    }
}
