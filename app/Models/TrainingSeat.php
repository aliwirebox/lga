<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This class could be refactored into two to different classes, Department and Skill. Currently
 * they are just two lists of possible tags with a lot of overlap. But I think if they start to
 * different behaviours the class/relationships should be refactored.
 */
class TrainingSeat extends Model
{
    protected $fillable = [
        'name',
        'is_department'
    ];

    /** Scopes **/
    public function scopeDepartment($query)
    {
        return $query->where('is_department', 1);
    }
}
