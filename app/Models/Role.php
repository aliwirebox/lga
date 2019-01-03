<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    /*** Relationships ***/

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
