<?php 

Route::group(['namespace' => 'Quarx', 'middleware' => ['web']], function () {

/*
|--------------------------------------------------------------------------
| Blogcategory App Routes
|--------------------------------------------------------------------------
*/

Route::resource('blogcategories', 'BlogcategoryController', ['only' => ['show', 'index']]);


});