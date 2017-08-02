<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use QueryRelationships;

    protected $fillable = [
        'name',
    ];

    /*** Mutators ***/

    public function getTopBandAttribute()
    {
        return $this->topBands()->first();
    }

    /*** Relationships ***/

    public function bands()
    {
        return $this->belongsToMany(UniversityBand::class);
    }

    public function topBands()
    {
        return $this->bands()->orderBy('rank', 'DESC');
    }
}
