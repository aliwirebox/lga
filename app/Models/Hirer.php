<?php

namespace App\Models;

class Hirer extends BaseUser
{
    use VerifyEmail;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'law_firm_id',
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::bootVerifyEmail();
    }

    public function getUserType()
    {
        return 'hirer';
    }

    public function getHomeRoute()
    {
        return route('hirer.dashboard');
    }

    public function getNotificationCount()
    {
        return $this->lawFirmSearches()
            ->active()
            ->get()
            ->sum('unviewed_matches_count');
    }

    public function lawFirmSearches()
    {
        return $this->lawFirm->searches();
    }

    /*** Pseudo Relationships ***/

    public function lawFirmBands()
    {
        return $this->lawFirm->bands;
    }

    /*** Relationships ***/

    public function lawFirm()
    {
        return $this->belongsTo(LawFirm::class);
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }
}
