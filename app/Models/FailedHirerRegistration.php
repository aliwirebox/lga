<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedHirerRegistration extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'password',
        'add_law_firm',
        'law_firm_id',
    ];
}
