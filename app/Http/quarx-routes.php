<?php

    /*
    |--------------------------------------------------------------------------
    | Quarx Routes
    |--------------------------------------------------------------------------
    */

    Route::group(['namespace' => 'Quarx'], function () {

        Route::get('blog', 'BlogController@all');
        Route::get('blog/{url}', 'BlogController@show');
        Route::get('blog/tags/{tag}', 'BlogController@tag');
        Route::get('blog/categories/{category}', 'BlogCategoryController@show');
        Route::get('{url}', 'PagesController@show');
    });
