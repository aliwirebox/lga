<?php

namespace Quarx\Modules\Blogcategories\Services;

use Config;
use Quarx\Modules\Blogcategories\Repositories\BlogcategoryRepository;

class BlogcategoryService
{
    public function __construct(BlogcategoryRepository $blogcategoryRepository)
    {
        $this->repo = $blogcategoryRepository;
    }

    public function all()
    {
        return $this->repo->all();
    }

    public function paginated()
    {
        return $this->repo->paginated(Config::get('quarx.pagination', 25));
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
    public function findBlogsByCategoryURL($url)
    {
        return $this->repo->findBlogsByCategoryURL($url, Config::get('quarx.pagination', 25));
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