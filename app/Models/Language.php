<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
    ];

    /*** Relationships ***/
    public function candidates() 
    {
        return $this->belongsToMany(Candidates::class);
    }
}
