<?php

namespace App\Models;

use App\Scopes\CountUnviewedMatches;
use App\Scopes\LawFirmOptionScope;
use Illuminate\Database\Eloquent\Builder;
use Log;

class Candidate extends BaseUser
{
    use QueryRelationships,
        VerifyEmail;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'telephone',
        'cv_name',
        'cv_size',
        'ucas_points',
        'degree_class',
        'training_law_firm_id',
        'taken_client_secondment',
        'date_qualified',
        'current_law_firm_id',
        'did_training_firm_offer_position',
        'minimum_salary',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_qualified',
    ];

    protected static function boot()
    {
        parent::boot();

        static::bootVerifyEmail();

        static::addGlobalScope(new CountUnviewedMatches);
    }

    public function getUserType()
    {
        return 'candidate';
    }

    public function getHomeRoute()
    {
        $route = ($this->isLive()) ? 'candidate.dashboard' : 'candidate.register.details';

        return route($route);
    }

    public function isLive()
    {
        return $this->is_live;
    }

    public function isEmployedByTrainingFirm()
    {
        if (!$this->currentLawFirm || !$this->trainingLawFirm) {
            return null;
        }

        return $this->currentLawFirm->id == $this->trainingLawFirm->id;
    }

    public function currentLawFirm()
    {
        return $this->belongsTo(LawFirm::class, 'current_law_firm_id')->withoutGlobalScope(new LawFirmOptionScope);
    }

    public function getNotificationCount()
    {
        return $this->unviewed_matches_count;
    }

    public function setCvRequestMatchesAsViewed()
    {
        $this->cvRequestMatches()
            ->newPivotStatement()
            ->where('status', config('match.cv-request'))
            ->update(['candidate_viewed' => true]);

        return $this;
    }

    public function cvRequestMatches()
    {
        return $this->matches()
            ->where('status', config('match.cv-request'));
    }

    public function matches()
    {
        return $this->belongsToMany(Search::class)
            ->withoutGlobalScope(CountUnviewedMatches::class)//remove searches global relationship count otherwise a endless loop is created
            ->withPivot('status', 'candidate_viewed')
            ->withTimestamps();
    }

    /*** Mutators ***/

    public function getCurrentLawFirmTopBandNameAttribute()
    {
        if ($this->currentLawFirm) {
            return $this->currentLawFirm->topBand->name;
        }

        return 'Not Working';
    }

    public function getDegreeClassTextAttribute()
    {
        return getCandidateDegreeClassText($this->degree_class);
    }

    public function getMinimumSalaryTextAttribute()
    {
        return formatCandidateSalary($this->minimum_salary);
    }

    public function getReferenceAttribute()
    {
        return sprintf( config('brand.identity.initials') .'S%s', $this->id);
    }

    /*** Scopes ***/

    public function scopeWhereLive($query)
    {
        $query->where('is_live', true);
    }

    /*** Relationships ***/

    public function referrer()
    {
        return $this->belongsTo(Candidate::class, 'refer_id');
    }

    public function referrals()
    {
        return $this->hasMany(Candidate::class, 'refer_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function preferedLocations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function preferedDepartments()
    {
        return $this->belongsToMany(TrainingSeat::class, 'candidate_department');
    }

    public function preferedLawFirmBands()
    {
        return $this->belongsToMany(LawFirmBand::class);
    }

    public function trainingLawFirm()
    {
        return $this->belongsTo(LawFirm::class, 'training_law_firm_id');
    }

    public function trainingSeats()
    {
        return $this->belongsToMany(TrainingSeat::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function unviewedMatches()
    {
        return $this->cvRequestMatches()->wherePivot('candidate_viewed', false);
    }
}
