<?php

namespace App\Models\Quarx;

class Page extends QuarxModel
{
    protected $table = 'pages';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
        'url' => 'required',
    ];
}
