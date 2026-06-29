<?php

namespace App\Models\Quarx;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'location' => 'mimes:jpeg,jpg,bmp,png,gif',
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['url'] = $this->url;

        return $array;
    }

    public function getUrlAttribute()
    {
        return url('storage/'.$this->location);
    }
}
