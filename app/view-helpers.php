<?php

function getTypeOfFirmOptionList($lawFirmBandList)
{
    $optionList = [
        'genericBands'   => [
            'name'       => 'Generic Bands:',
            'optionList' => [],
        ],
        'topRankedFor'   => [
            'name'       => 'Top Ranked for (London firms only):',
            'optionList' => [],
        ],
    ];

    foreach ($lawFirmBandList as $band) {
        if (count($band->children) > 0) {
            $optionList['topRankedFor']['optionList'][] = [
                'band'        => $band,
                'displayName' => $band->name . ' (All)',
            ];
        } else {
            $optionList['genericBands']['optionList'][] = [
                'band'        => $band,
                'displayName' => $band->name,
            ];
        }
    }

    return $optionList;
}

function getTypeOfFirmOptionChildData(App\Models\LawFirmBand $parent, $selected = [], $old = null)
{
    /*
     * due to the submitted data being in a multidimensional array
     * we have to check for its exsistance and pass it through checkFirms
     * to flattern the array.
     */
    if (is_array($old)) {
        $selected = checkFirm($old);
    }

    return $parent->children->map(function ($item) use ($selected) {
        $item->selected = in_array($item->id, $selected);

        return $item;
    });
}

function isMultiSelected($value, $data, $old)
{
    $idArray = (is_object($data) ? $data->lists('id')->toArray() : '');

    return (is_array(old($old, $idArray)) && in_array($value, old($old, $idArray)));
}

function toCssClass($string)
{
    return strtolower(preg_replace('/[^A-Za-z0-9]/', '-', $string));
}

function outputLabelText($text, $count, $index)
{
    return $text . '' . ((($index < 1) && ($index < ($count - 1))) ? ',' : '');
}

function getCandidateDegreeClassText($index)
{
    $degreeClassList = config('degree-class.candidate-options');

    return $degreeClassList[$index];
}

function getSearchDegreeClassText($index)
{
    $degreeClassList = config('degree-class.search-options');

    return $degreeClassList[$index];
}

function getCvDownloadButtonOrUnavailable(App\Models\Candidate $candidate)
{
    if (!empty($candidate->cv_name)) {
        return getCvDownloadButton($candidate->id);
    }

    return 'Unavailable';
}

function getCvDownloadButton($candidateId)
{
    $route = route('brand-admin.cv-download', $candidateId);

    return sprintf('<a href="%s" class="btn btn-rounded btn-primary btn-block btn-xs btn-pad-20">Download</a>', $route);
}

function getMatchStatusButton($statusIndex)
{
    return getMatchButton($statusIndex, 'match-status btn-pad-20');
}

function getMatchUpdateButton($statusIndex, $classes = '')
{
    return getMatchButton($statusIndex, 'cv-request-buttons');
}

function getMatchButton($statusIndex, $classes = '')
{
    if ($statusIndex === 0) {
        return '';
    }

    $guard = getGuard();

    $statusList = config('match.statuses');
    $colour = $statusList[$statusIndex][$guard]['colour'];
    $text = $statusList[$statusIndex][$guard]['text'];

    return sprintf('<a data-status="%s" href="#" class="btn btn-rounded btn-block btn-xs cursor-text %s %s">%s</a>', $statusIndex, $colour, $classes, $text);
}

function getMatchAdditionalInformationButton($additionalInformation)
{
    if (!isset($additionalInformation) or $additionalInformation == '') {
        return '';
    }

    $text = "View";

    return sprintf('<a href="#" 
        data-title="Additional Information"
        data-template=".additional-information-modal-template"
        data-information="%s"
        class="match-additional-information">%s</a>
', $additionalInformation, $text);
}

function boolToText($bool)
{
    return $bool ? 'Yes' : 'No';
}

function boolToSearchText($bool)
{
    return $bool ? 'Yes' : "Doesn't Matter";
}

function formatDate($format, $date)
{
    return date('d/m/Y', strtotime($date));
}

function formatSearchDate($format, $date)
{
    if (!$date) {
        return 'Any';
    }

    return $date->format($format);
}

function formatCandidateSalary($salary)
{
    $options = config('salary-map.candidate-options');

    return isset($options[$salary]) ? $options[$salary] : sprintf('%sk+', $salary);
}

function formatTelephone($telephone)
{
    if (!$telephone and !isset($telephone)) {
        return '';
    }

    if (strpos($telephone, ' ')) {
        return $telephone;
    } else {
        if (strlen($telephone) == 11) {
            return substr_replace($telephone, ' ', 5, 0);
        } else {
            return $telephone;
        }
    }
}

function formatVacancySalary($salary)
{
    $options = config('salary-map.vacancy-options');

    return isset($options[$salary]) ? $options[$salary] : sprintf('to %sk', $salary);
}

function getFullName($first, $last)
{
    return sprintf('%s %s', $first, $last);
}

function humanFilesize($bytes, $decimals = 2)
{
    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function removeTopRankedFor($text)
{
    return str_replace('Top Ranked for', '', $text);
}

function getCandidateEmployedByTrainingFirmText($candidate)
{
    $answer = $candidate->isEmployedByTrainingFirm();

    if ($answer === true) {
        return 'Yes';
    } elseif ($answer === false) {
        return 'No';
    }

    return 'Not Working';
}

function getCandidateOfferedBrandPositionByTrainingFirmText($candidate)
{
    $answer = $candidate->did_training_firm_offer_position;

    if ($answer === 0) {
        return 'No';
    } elseif ($answer === 1) {
        return 'Yes';
    }

    return 'N/A';
}

function linkEmail($email)
{
    return sprintf('<a href="mailto:%s">%s</a>', $email, $email);
}

function getUnviewedMatchesCount($count)
{
    if ($count > 0) {
        return sprintf('<span style="color:red">%s</span>', $count);
    }

    return sprintf('%s', $count);
}
