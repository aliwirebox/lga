<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use NodeTrait;

    protected $fillable = [
        'name',
    ];

    /*** Relationships ***/

    public function candidates()
    {
        return $this->belongsToMany(Candidates::class);
    }
}
