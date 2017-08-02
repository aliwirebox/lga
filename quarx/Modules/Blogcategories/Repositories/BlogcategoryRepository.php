<?php

namespace Quarx\Modules\Blogcategories\Repositories;

use Quarx\Modules\Blogcategories\Models\Blogcategory;
use Illuminate\Support\Facades\Schema;

class BlogcategoryRepository
{
    public function __construct(Blogcategory $blogcategory)
    {
        $this->model = $blogcategory;
    }

    /**
     * Returns all Blogcategories
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    /**
     * Returns all paginated $MODEL_NAME_PLURAL$
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function paginated($paginate)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($paginate);
    }

    /**
     * Search Blogcategory
     *
     * @param string $input
     *
     * @return Blogcategory
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('blog_categories');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };
        
        return $query->paginate($paginate);
    }

    /**
     * Stores Blogcategory into database
     *
     * @param array $input
     *
     * @return Blogcategory
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Find Blogcategory by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Blogcategory
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find Blogs by given Category URL
     *
     * @param string $url
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findBlogsByCategoryURL($url, $paginate)
    {
        $blogcategories = $this->model->where('url', $url)->first();

        $blogs=null;
        if($blogcategories){
            $blogs= $blogcategories->blogs()->paginate($paginate);
        }
        
        return $blogs;
    }

    /**
     * Destroy Blogcategory
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Blogcategory
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Updates Blogcategory in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Blogcategory
     */
    public function update($id, $inputs)
    {
        $blogcategory = $this->model->find($id);
        $blogcategory->fill($inputs);
        $blogcategory->save();

        return $blogcategory;
    }
}