<?php

namespace App\Models;

use App\Scopes\CountUnviewedMatches;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public $attributes = [
        "date_qualified_from"     => null,
        "date_qualified_to"       => null,
        "min_ucas_points"         => 0,
        "min_degree_class"        => 0,
        "taken_client_secondment" => null,
    ];

    protected $fillable = [
        'name',
        'date_qualified_from',
        'date_qualified_to',
        'hirer_id',
        'min_ucas_points',
        'min_degree_class',
        'taken_client_secondment',
        'vacancy_additional_information',
        'vacancy_salary',
        'vacancy_department_id',
        'vacancy_location_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_qualified_from',
        'date_qualified_to',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CountUnviewedMatches);
    }

    public function matches()
    {
        return $this->belongsToMany(Candidate::class)
            ->withoutGlobalScope(CountUnviewedMatches::class)//remove candidates global relationship count otherwise a endless loop is created
            ->withPivot('status', 'hirer_viewed')
            ->withTimestamps();
    }

    public function updateMatches()
    {
        $foundMatches = $this->findCandidates();

        $syncMatches = $this->contactedMatches->merge($foundMatches); // do not delete candidates that have been contacted

        return $this->matches()->sync($syncMatches);

        /*
            returns an array of ids that have been
            created/deleted/updated

            [
                "attached" => [164, 165],
                "detached" => [],
                "updated" => []
            ]
        */
    }

    public function findCandidates()
    {
        $query = Candidate::withoutGlobalScopes()->whereLive();

        $query->whereAnyRelationIds('preferedDepartments', [$this->vacancy_department_id]);

        /*
         * Very important that a candidate is never returned in a search
         * by their current law firm or training firm.
         */
        $query->where('training_law_firm_id', '<>', $this->lawFirm()->id);

        $query->where(function ($query) {
            $query->whereNull('current_law_firm_id')
                ->orWhere('current_law_firm_id', '<>', $this->lawFirm()->id);
        });

        if ($this->min_ucas_points) {
            $query->where('ucas_points', '>=', $this->min_ucas_points);
        }

        if ($this->min_degree_class) {
            $query->where('degree_class', '>=', $this->min_degree_class);
        }

        if ($this->date_qualified_from) {
            $query->where('date_qualified', '>=', $this->date_qualified_from);
        }

        if ($this->date_qualified_to) {
            $query->where('date_qualified', '<=', $this->date_qualified_to);
        }

        if ($this->did_training_firm_offer_position) {
            $query->where('did_training_firm_offer_position', true);
        }

        if ($this->taken_client_secondment) {
            $query->where('taken_client_secondment', true);
        }

        if ($this->vacancy_salary) {
            $query->where('minimum_salary', '<=', $this->vacancy_salary);
        }

        if ($this->vacancy_location_id) {
            $query->whereAnyRelationIds('preferedLocations', [$this->vacancy_location_id]);
        }

        $languageIdList = $this->languages->pluck('id')->toArray();

        if ($languageIdList) {
            $query->whereAnyRelationIds('languages', $languageIdList);
        }

        $trainingSeatIdList = $this->trainingSeats->pluck('id')->toArray();

        if ($trainingSeatIdList) {
            $query->whereAnyRelationIds('trainingSeats', $trainingSeatIdList);
        }

        $lawFirmBandIdList = $this->lawFirmBands()->pluck('id')->toArray();

        if ($lawFirmBandIdList) {
            $query->whereAnyRelationIds('preferedLawFirmBands', $lawFirmBandIdList);
        }

        $trainingLawFirmBandsIdList = $this->trainingLawFirmBands->pluck('id')->toArray();

        if ($trainingLawFirmBandsIdList) {
            $query->whereHas('trainingLawFirm', function ($query) use ($trainingLawFirmBandsIdList) {
                $query->whereAnyRelationIds('bands', $trainingLawFirmBandsIdList);
            });
        }

        $uniBandIdList = $this->universityBands->pluck('id')->toArray();

        if ($uniBandIdList) {
            $query->whereHas('university', function ($query) use ($uniBandIdList) {
                $query->whereAnyRelationIds('bands', $uniBandIdList);
            });
        }

        return $query->get();
    }

    /*** Mutators ***/

    public function getMinDegreeClassTextAttribute()
    {
        return getSearchDegreeClassText($this->min_degree_class);
    }

    public function getTakenClientSecondmentTextAttribute()
    {
        return boolToSearchText($this->taken_client_secondment);
    }

    public function getVacancySalaryTextAttribute()
    {
        return formatVacancySalary($this->vacancy_salary);
    }

    /*** Scopes ***/

    public function scopeActive($query)
    {
        return $query->where('name', '<>', '');
    }

    /*** Pseudo Relationships ***/

    public function lawFirm()
    {
        return $this->hirer->lawFirm;
    }

    public function lawFirmBands()
    {
        return $this->hirer->lawFirmBands();
    }

    /*** Relationships ***/

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function hirer()
    {
        return $this->belongsTo(Hirer::class);
    }

    public function contactedMatches()
    {
        return $this->matches()->wherePivot('status', '>', 0);
    }

    public function cvRequestedMatches()
    {
        return $this->matches()->where('status', config('match.cv-request'));
    }


    public function trainingLawFirmBands()
    {
        return $this->belongsToMany(LawFirmBand::class);
    }

    public function trainingSeats()
    {
        return $this->belongsToMany(TrainingSeat::class);
    }

    public function universityBands()
    {
        return $this->belongsToMany(UniversityBand::class);
    }

    public function uncontactedMatches()
    {
        return $this->matches()
            ->wherePivot('status', 0);
    }

    public function unviewedMatches()
    {
        return $this->matches()
            ->wherePivot('hirer_viewed', false);
    }

    public function vacancyDepartment()
    {
        return $this->belongsTo(TrainingSeat::class, 'vacancy_department_id');
    }

    public function vacancyLocation()
    {
        return $this->belongsTo(Location::class, 'vacancy_location_id');
    }
}
