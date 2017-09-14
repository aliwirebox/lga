<?php

use Carbon\Carbon;

function transformBaseMatchForDatatable($candidate)
{
    $matchCreatedAt = new Carbon($candidate->match_created_at);
    $matchUpdatedAt = new Carbon($candidate->match_updated_at);

    /*
     * Important that the contact details of the canidate or hirer is not passed
     */
    return [
        'id'                               => $candidate->id,
        'reference'                        => $candidate->reference,
        'ucas_points'                      => $candidate->ucas_points,
        'degree_class'                     => $candidate->degree_class_text,
        'taken_client_secondment'          => boolToText($candidate->taken_client_secondment),
        'did_training_firm_offer_position' => getCandidateOfferedBrandPositionByTrainingFirmText($candidate),
        'languages'                        => $candidate->languages->lists('name'),
        'training_seats'                   => $candidate->trainingSeats->lists('name'),
        'date_qualified'                   => $candidate->date_qualified->format('F Y'),
        'current_law_firm_band'            => $candidate->currentLawFirmTopBandName,
        'university_band'                  => $candidate->university->topBand->displayName,
        'training_law_firm_band'           => $candidate->trainingLawFirm->topBand->name,
        'deleted_at_ddmmyyyy'              => convertDateIfCarbon('d/m/Y', $candidate->deleted_at),
        'created_at_sort'                  => $candidate->created_at->format('Y-m-d H:i:s'),
        'updated_at_sort'                  => $candidate->updated_at->format('Y-m-d H:i:s'),


        'match_status_num'                            => $candidate->match_status_num,
        'match_status_text'                           => getMatchStatusButton($candidate->match_status_num),
        'match_created_at_sort'                       => $matchCreatedAt->format('Y-m-d H:i:s'),
        'match_created_at_ddmmyyyy'                   => $matchCreatedAt->format('d/m/Y'),
        'match_created_at_human'                      => $matchCreatedAt->diffForHumans(),
        'match_updated_at_sort'                       => $matchUpdatedAt->format('Y-m-d H:i:s'),
        'match_updated_at_ddmmyyyy'                   => $matchUpdatedAt->format('d/m/Y'),
        'match_updated_at_human'                      => $matchUpdatedAt->diffForHumans(),
        'match_search_id'                             => $candidate->match_search_id,
        'match_search_name'                           => $candidate->match_search_name,
        'match_vacancy_location'                      => $candidate->match_vacancy_location,
        'match_vacancy_department'                    => $candidate->match_vacancy_department,
        'match_vacancy_salary'                        => $candidate->match_vacancy_salary,
        'match_vacancy_salary_text'                   => formatVacancySalary($candidate->match_vacancy_salary),
        'match_vacancy_additional_information'        => $candidate->match_vacancy_additional_information,
        'match_vacancy_additional_information_button' => getMatchAdditionalInformationButton($candidate->match_vacancy_additional_information),
        'match_hirer_law_firm_name'                   => $candidate->match_hirer_law_firm_name,
    ];
}

function transformCandidateMatchForDatatable($candidate)
{
    /*
     * Important that the hirer contact details are not passed
     */
    $baseData = transformBaseMatchForDatatable($candidate);

    $additionalData = [
        'full_name'               => $candidate->getFullName(),
        'minimum_salary'          => $candidate->minimum_salary,
        'minimum_salary_text'     => $candidate->minimum_salary_text,
        'prefered_departments'    => $candidate->preferedDepartments->lists('name'),
        'prefered_law_firm_bands' => $candidate->preferedLawFirmBands()->childless()->get()->lists('name'),
        'prefered_locations'      => $candidate->preferedLocations->lists('name'),
        'match_search_endpoint'   => route('candidate.cv-requests-pending.update', $candidate->match_search_id),
    ];

    return array_merge($baseData, $additionalData);
}

function transformHirerMatchForDatatable($candidate)
{
    /*
     * Important that the candidate contact details are not passed
     */
    $baseData = transformBaseMatchForDatatable($candidate);

    $additionalData = [
        'match_hirer_name'       => getFullName($candidate->match_hirer_first_name, $candidate->match_hirer_last_name),
        'match_hirer_viewed'     => (bool)$candidate->match_hirer_viewed,
    ];

    return array_merge($baseData, $additionalData);
}

function transformHirerMatchForLiveCandidatetable($candidate)
{
    /*
     * When a candidate becomes live for a hirer, the hirer
     * is allowed to see the canidates name.
     */
    $hirerData = transformHirerMatchForDatatable($candidate);

    $additionalData = [
        'full_name' => $candidate->getFullName(),
    ];

    return array_merge($hirerData, $additionalData);
}

function transformBrandMatchForDatatable($candidate)
{
    $baseData = transformBaseMatchForDatatable($candidate);

    $additionalData = [
        'full_name'                   => $candidate->getFullName(),
        'email'                       => linkEmail($candidate->email),
        'minimum_salary'              => $candidate->minimum_salary,
        'minimum_salary_text'         => $candidate->minimum_salary_text,
        'prefered_departments'        => $candidate->preferedDepartments->lists('name'),
        'prefered_law_firm_bands'     => $candidate->preferedLawFirmBands()->childless()->get()->lists('name'),
        'prefered_locations'          => $candidate->preferedLocations->lists('name'),
        'telephone'                   => $candidate->telephone,
        'match_hirer_name'            => getFullName($candidate->match_hirer_first_name, $candidate->match_hirer_last_name),
        'match_search_endpoint'       => route('brand-admin.search.update', $candidate->match_search_id),
        'match_hirer_email'           => linkEmail($candidate->match_hirer_email),
        'match_hirer_law_firm_name'   => $candidate->match_hirer_law_firm_name,
        'match_candidate_cv_download' => getCvDownloadButton($candidate->id),
    ];

    return array_merge($baseData, $additionalData);
}

function checkFirm($input)
{
    $selected = [];

    foreach ($input as $firm) {
        if (is_array($firm)) {
            foreach ($firm as $innerFirm) {
                $selected[] = $innerFirm[0];
            }
        } else {
            $selected[] = $firm;
        }
    }

    return array_unique($selected);
}

function getCsvConfigKeys($configName)
{
    return implode(',', array_keys(config($configName)));
}

function castTextInput($request, $inputName, $default = null)
{
    $value = $request->input($inputName);

    return !empty($value) ? $value : $default;
}

function convertDateIfCarbon($to, $date)
{
    $formattedDate = null;

    if ($date instanceof Carbon) {
        $formattedDate = $date->format($to);
    }

    return $formattedDate;
}
