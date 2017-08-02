<div class="col-md-3 col-sm-4 nq-sidebar">
    <div class="pad-30-well m-top-50 ">
        <h4 class="heading">Categories</h4>
        <ul class="arrow-list">
            @foreach($blogcategories as $blogcategory)
                <li><a class="blogcategories"
                       href="{{ url('blog/categories/'.$blogcategory->url) }}">{{ $blogcategory->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="pad-30-well m-top-30 ">
        <h4 class="heading">Tags</h4>
        <div class="tags">
            @foreach($tags as $tag)
                <a href="{{ url('blog/tags/'.$tag) }}"><span class="label label-primary">{{ $tag }}</span></a>
            @endforeach
        </div>
    </div>
</div>
