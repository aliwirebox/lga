<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LawFirmDomain extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function lawFirm()
    {
        return $this->belongsTo('App\Models\LawFirm');
    }
}
