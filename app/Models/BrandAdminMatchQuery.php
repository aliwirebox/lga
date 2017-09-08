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
 * match_hirer_law_firm_name
 *
 */
class BrandAdminMatchQuery extends MatchQuery
{
    protected static function getBaseQuery()
    {
        return parent::getBaseQuery()
            ->addSelect('hirers.email as match_hirer_email')
            ->addSelect('hirers.last_name as match_hirer_last_name');
    }

    public static function getCvRequestedMatches()
    {
        return static::getBaseQuery()
            ->where('candidate_search.status', config('match.cv-request'))
            ->orderBy('candidate_search.updated_at', 'desc');
    }

    public static function getCvPendingMatches()
    {
        return static::getBaseQuery()
            ->where('candidate_search.status', config('match.cv-pending'))
            ->orderBy('candidate_search.updated_at', 'desc');
    }

    public static function getLiveCandidatesMatches()
    {
        return static::getBaseQuery()
            ->where('candidate_search.status', '>',  config('match.cv-pending'))
            ->orderBy('candidate_search.updated_at', 'desc');
    }
}
