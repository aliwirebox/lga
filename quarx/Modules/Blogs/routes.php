<?php 

Route::group(['namespace' => 'Quarx\Modules\Blogs\Controllers', 'prefix' => 'quarx', 'middleware' => ['web', 'auth:brand_admins']], function () { 

    Route::resource('blogs', 'BlogController', ['except' => ['show']]);
    Route::post('blogs/search', 'BlogController@search');

});
