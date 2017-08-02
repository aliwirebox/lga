<?php

namespace Quarx\Modules\Blogs\Services;

use Config;
use Quarx\Modules\Blogs\Repositories\BlogRepository;

class BlogService
{
    public function __construct(BlogRepository $blogRepository)
    {
        $this->repo = $blogRepository;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function paginated()
    {
        return $this->repo->paginated(Config::get('quarx.pagination', 25));
    }
    
    public function publishedAndPaginated()
    {
        return $this->repo->publishedAndPaginated(Config::get('quarx.pagination', 25));
    }
    
    public function published()
    {
        return $this->repo->published(Config::get('quarx.pagination', 25));
    }
    
    public function tags($tag)
    {
        return $this->repo->tags($tag);
    }
    
    public function allTags()
    {
        return $this->repo->allTags();
    }

    public function search($input)
    {
        return $this->repo->search($input, Config::get('quarx.pagination', 25));
    }
    
    public function create($input)
    {
        return $this->repo->create($input);
    }
    
    public function find($id)
    {
        return $this->repo->find($id);
    }
    
    public function findBlogsByURL($url)
    {
        return $this->repo->findBlogsByURL($url);
    }
    
    public function findBlogsByTag($tag)
    {
        return $this->repo->findBlogsByTag($tag);
    }

    public function update($id, $input)
    {
        return $this->repo->update($id, $input);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }

}