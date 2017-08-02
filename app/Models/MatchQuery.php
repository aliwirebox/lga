<?php

namespace App\Models;

use DB;

/**
 * These querys return Candidate models with the following
 * additional fields:
 *
 * match_search_name
 * match_vacancy_salary
 * match_vacancy_department
 * match_created_at
 * match_updated_at
 * match_status_num
 * match_hirer_first_name
 * match_hirer_last_name
 *
 */
class MatchQuery
{
    public static function getAllMatchesByCandidate($id)
    {
        return static::getBaseQuery()
            ->where('candidates.id', $id);
    }

    public static function getAllMatchesByLawFirm($id)
    {
        return static::getBaseQuery()
            ->where('hirers.law_firm_id', $id);
    }

    public static function getAllMatchesBySearch($id)
    {
        return static::getBaseQuery()
            ->where('searches.id', $id)
            ->orderBy('match_created_at', 'desc');
    }

    protected static function getBaseQuery()
    {
        return Candidate::with([
            'currentLawFirm',
            'languages',
            'preferedDepartments',
            'preferedLawFirmBands',
            'preferedLocations',
            'trainingLawFirm',
            'trainingSeats',
            'university',
        ])
        ->select(
            'candidates.*',
            'searches.id as match_search_id',
            'searches.name as match_search_name',
            'searches.vacancy_salary as match_vacancy_salary',
            'searches.vacancy_additional_information as match_vacancy_additional_information',
            'locations.name as match_vacancy_location',
            'training_seats.name as match_vacancy_department',
            'candidate_search.created_at as match_created_at',
            'candidate_search.updated_at as match_updated_at',
            'candidate_search.status as match_status_num',
            'candidate_search.hirer_viewed as match_hirer_viewed',
            'hirers.first_name as match_hirer_first_name',
            'law_firms.name as match_hirer_law_firm_name'
        )
        ->join('candidate_search', 'candidates.id', '=', 'candidate_search.candidate_id')
        ->join('searches', 'candidate_search.search_id', '=', 'searches.id')
        ->join('locations', 'searches.vacancy_location_id', '=', 'locations.id')
        ->join('training_seats', 'searches.vacancy_department_id', '=', 'training_seats.id')
        ->join('hirers', 'searches.hirer_id', '=', 'hirers.id')
        ->join('law_firms', 'hirers.law_firm_id', '=', 'law_firms.id');
    }
}
