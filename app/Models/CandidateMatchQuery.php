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
class CandidateMatchQuery extends MatchQuery
{
    public static function getUnsuccessfulMatchesByCandidate($id)
    {
        return static::getAllMatchesByCandidate($id)
            ->where(function ($query) {
                $query->where('candidate_search.status', config('match.unsuccessful'))
                    ->orWhere('candidate_search.status', config('match.cv-rejected'));
            })
            ->orderBy('candidate_search.updated_at', 'desc');
    }

    public static function getLiveMatchesByCandidate($id)
    {
        return static::getAllMatchesByCandidate($id)
            ->where('candidate_search.status', '>', config('match.cv-rejected'))
            ->orderBy('candidate_search.updated_at', 'desc');
    }

    public static function getCvRequestedMatchesByCandidate($id)
    {
        return static::getAllMatchesByCandidate($id)
            ->where('candidate_search.status', config('match.cv-request'))
            ->orderBy('candidate_search.updated_at', 'desc');
    }
}
