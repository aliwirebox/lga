<?php 

Route::group(['namespace' => 'Quarx\Modules\Blogcategories\Controllers', 'prefix' => 'quarx', 'middleware' => ['web', 'auth:nq_admins']], function () { 

Route::resource('blogcategories', 'BlogcategoryController', ['except' => ['show']]);
Route::post('blogcategories/search', 'BlogcategoryController@search');

});
