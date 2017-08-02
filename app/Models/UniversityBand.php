<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityBand extends Model
{
    protected $fillable = [
        'name',
    ];

    /*** Mutators ***/

    public function getDisplayNameAttribute()
    {
        if ($this->name == 'All') {
            return 'UK University';
        }

        return $this->name;
    }

    /*** Relationships ***/

    public function universities()
    {
        return $this->belongsToMany(University::class);
    }
}
