<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as DefaultController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends DefaultController
{
    public function get()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 60);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(route('home'), \Carbon\Carbon::now()->toIso8601String(), '1.0', 'daily');
            $sitemap->add(route('contact-us'), \Carbon\Carbon::now()->toIso8601String(), '0.9', 'daily');

            // BLOG
            $sitemap->add(URL::to('blog'), \Carbon\Carbon::now()->toIso8601String(), '0.9', 'daily');

            $posts = \Quarx\Modules\Blogs\Models\Blog::where('is_published', true)->orderBy('published_at', 'desc')->get();
            foreach ($posts as $post) {
                $sitemap->add(URL::to('blog/'.$post->url), $post->updated_at, '0.75', 'daily');
            }

            // BLOG CATEGORIES
            $posts = \Quarx\Modules\Blogcategories\Models\Blogcategory::orderBy('updated_at', 'desc')->get();
            foreach ($posts as $post) {
                $sitemap->add(URL::to('blog/categories/'.$post->url), $post->updated_at, '0.8', 'daily');
            }

            // PAGES
            $pages = \App\Models\Quarx\Page::where('is_published', true)->orderBy('published_at', 'desc')->get();
            foreach ($pages as $page) {
                $sitemap->add(URL::to($page->url), $page->updated_at, '0.9', 'daily');
            }
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
