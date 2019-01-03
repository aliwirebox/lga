<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Hirer extends BaseUser
{
    use SoftDeletes,
        VerifyEmail;

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

    public function delete()
    {
        DB::table('searches')
            ->where('hirer_id', $this->id)
            ->update(['name' => '']);

        DB::table('candidate_search')
            ->join('searches', 'searches.id', '=', 'candidate_search.search_id')
            ->where('searches.hirer_id', $this->id)
            ->where('candidate_search.status', 0)
            ->delete();

        DB::table('candidate_search')
            ->join('searches', 'searches.id', '=', 'candidate_search.search_id')
            ->where('searches.hirer_id', $this->id)
            ->update(['status' => config('match.unsuccessful')]);

        return parent::delete();
    }

    public function getUserType()
    {
        return 'hirer';
    }

    public function getHomeRoute()
    {
        return route('hirer.dashboard');
    }

    public function getVerifiedRoute()
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
