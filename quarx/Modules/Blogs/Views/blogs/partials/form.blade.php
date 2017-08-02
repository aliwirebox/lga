<div class="form-group ">
    <label for="categories" class="control-label">Categories</label>
    <select id="categories" name="categories[]" class="form-control" multiple>
        @foreach($blogCategories as $category)
            <option value="{{ $category->id }}"
                    {{($blogCategoriesArray && in_array(intval($category->id),$blogCategoriesArray) ? 'selected="selected"' : '')}}
            >{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group ">
    <label for="image" class="control-label">Image</label>
    <select id="image" name="image" class="form-control">
        @foreach($images as $image)
            <option value="{{ $image->id }}"
                    {{( isset( $blog->image->id) && $blog->image->id==$image->id ? 'selected="selected"' : '')}}
            >{{(isset($image->name) ? $image->name : $image->original_name)}}
            </option>
        @endforeach
    </select>
</div>