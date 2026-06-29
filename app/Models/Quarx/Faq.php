<?php

namespace App\Models\Quarx;

class Faq extends QuarxModel
{
    protected $table = 'faqs';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'question' => 'required',
    ];
}
