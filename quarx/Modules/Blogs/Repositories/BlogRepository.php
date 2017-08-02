<?php

namespace Quarx\Modules\Blogs\Repositories;

use Quarx\Modules\Blogs\Models\Blog;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Config;

class BlogRepository
{
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /**
     * Returns all Blogs
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
     *
     * @param type $paginate
     * @return type
     */
    public function publishedAndPaginated($paginate)
    {
        return $this->model->with('image')->orderBy('created_at', 'desc')->where('is_published', 1)->where('published_at', '<=', Carbon::now())->paginate($paginate);
    }
    
    /**
     *
     * @param type $paginate
     * @return type
     */
    public function published($paginate)
    {
        return Blog::where('is_published', 1)->where('published_at', '<=', Carbon::now())->orderBy('created_at', 'desc')->paginate($paginate);
    }
    
    /**
     *
     * @param type $tag
     * @return type
     */
    public function tags($tag)
    {
        return Blog::where('is_published', 1)->where('published_at', '<=', Carbon::now())->where('tags', 'LIKE', '%'.$tag.'%')->orderBy('created_at', 'desc')->paginate(Config::get('quarx.pagination', 25));
    }
    
    /**
     *
     * @return type
     */
    public function allTags()
    {
        $tags = [];
        $blogs = Blog::orderBy('created_at', 'desc')->get();

        foreach ($blogs as $blog) {
            foreach (explode(',', $blog->tags) as $tag) {
                array_push($tags, $tag);
            }
        }

        return array_unique($tags);
    }


    /**
     * Search Blog
     *
     * @param string $input
     *
     * @return Blog
     */
    public function search($input, $paginate)
    {
        $query = $this->model->orderBy('created_at', 'desc');

        $columns = Schema::getColumnListing('blogs');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($paginate);
    }
    
    /**
     * Stores Blog into database
     *
     * @param array $input
     *
     * @return Blog
     */
    public function create($input)
    {
        $blog = $this->model->create($input);
        
        //Add new categories
        $blogCatSelected = $input['categories'];
        if (count($blogCatSelected) > 0) {
            $blog->categories()->sync($blogCatSelected);
        }

        //Add the image
        if (isset($input['image'])) {
            $blog->image_id = $input['image'];
            $blog -> save();
        }
        
        return $blog;
    }
   
    /**
     * Find Blog by given id
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Blog
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
    
    /**
     * Find Blog by given URL
     *
     * @param string $url
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findBlogsByURL($url)
    {
        return $this->model->where('url', $url)->where('is_published', 1)->first();
    }
    
    /**
     * Find Blogs by given Tag
     *
     * @param string $tag
     *
     * @return \Illuminate\Support\Collection|null|static|Pages
     */
    public function findBlogsByTag($tag)
    {
        return $this->model->where('tags', 'LIKE', "%$tag%")->where('is_published', 1)->get();
    }

    /**
     * Destroy Blog
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null|static|Blog
     */
    public function destroy($id)
    {
        $blog = $this->model->find($id);
                
        $blog->categories()->sync([]);

        $delete = $blog->delete();
        
        return $delete;
    }

    /**
     * Updates Blog in the database
     *
     * @param int $id
     * @param array $inputs
     *
     * @return Blog
     */
    public function update($id, $inputs)
    {
        $blog = $this->model->find($id);
        $blog->fill($inputs);
        $blog->save();
        
        //Update the categories
        $blogCatSelected = $inputs['categories'];
        if (count($blogCatSelected) > 0) {
            $blog->categories()->sync($blogCatSelected);
        }

        //Update the image
        if (isset($inputs['image'])) {
            $blog->image_id = $inputs['image'];
            $blog -> save();
        }

        //Update post published
        if (!isset($inputs['is_published'])) {
            $blog->is_published = 0;
            $blog -> save();
        }

        return $blog;
    }
}
