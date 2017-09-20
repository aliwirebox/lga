<?php

namespace App\Models;

use App\Scopes\LawFirmOptionScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawFirm extends Model
{
    use SoftDeletes,
        QueryRelationships;

    protected $fillable = [
        'name',
        'is_option',
    ];

    public static function create(array $attributes = [])
    {
        $lawFirm = parent::create($attributes);

        $lawFirm->hirers()->create([
            'first_name'  => config('brand.identity.initials'),
            'last_name'   => 'Admin',
            'email'       => str_slug($lawFirm->name) . config('brand.email.domain'),
            'password'    => '', //leave blank so you have to login as an admin to access these accounts
            'telephone'   => '', //leave blank so admin pannel looks clean
        ]);

        $lawFirm->domains()->create(['name' => config('brand.email.domain')]);

        return $lawFirm;
    }

    public static function withOptions()
    {
        return with(new static)
            ->newQueryWithoutScope(new LawFirmOptionScope)
            ->orderBy('is_option', 'desc')
            ->orderBy('name', 'asc');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LawFirmOptionScope);
    }

    public function delete()
    {
        $this->hirers->each(function ($hirer) {
            $hirer->delete();
        });

        return parent::delete();
    }

    public function isAllowedEmail($email)
    {
        $domain = getDomainFromEmail($email);

        $matched = $this->domains->where('name', $domain);

        return $matched->count() > 0;
    }

    /*** Mutators ***/

    public function getTopBandAttribute()
    {
        return $this->topBands()->first();
    }

    /*** Relationships ***/

    public function bands()
    {
        return $this->belongsToMany(LawFirmBand::class)->withoutGlobalScope(new LawFirmOptionScope);
    }

    public function topBands()
    {
        return $this->bands()->orderBy('rank', 'DESC');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'current_law_firm_id')
                ->where();
    }

    public function domains()
    {
        return $this->hasMany(LawFirmDomain::class);
    }

    public function hirers()
    {
        return $this->hasMany(Hirer::class);
    }

    public function searches()
    {
        return $this->hasManyThrough(Search::class, Hirer::class);
    }
}
