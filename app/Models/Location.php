<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
    ];

    /*** Relationships ***/

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidates::class);
    }
}
