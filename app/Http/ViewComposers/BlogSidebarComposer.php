<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Quarx\Modules\Blogs\Services\BlogService;

class BlogSidebarComposer
{
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function compose(View $view)
    {
        $view->with('tags', $this->blogService->allTags());
    }
}
