<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Require CMS routes. Routes defined after
 * this file can overwrite any route in quarx-routes.php
 */
Route::get('register/{type?}', [
    'as'   => 'register',
    'uses' => 'Frontend\Register\Controller@index',
]);

// Route::auth() removed for Laravel 13 compatibility
Route::get('auth/{socialProvider}/{userType}/{accessType}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/linkedin/callback', 'Auth\AuthController@handleLinkedinProviderCallback');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout');

Route::get('password/reset', 'Auth\PasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::get('email/verify/{token}', [
    'as'   => 'auth.verify-email',
    'uses' => 'Auth\VerifyEmailController@verifyEmail',
]);

Route::get('/', [
    'as'   => 'home',
    'uses' => 'Frontend\HomeController@index',
]);

Route::get('sitemap.xml', [
    'as'   => 'sitemap',
    'uses' => 'Frontend\SitemapController@get',
]);

Route::get('contact-us', [
    'as'   => 'contact-us',
    'uses' => 'Frontend\Contactus\Controller@index',
]);


Route::get('how-it-works/candidate', [
    'as'   => 'how-it-works-candidate',
    'uses' => 'Frontend\HowItWorksCandidate\Controller@index',
]);

Route::get('how-it-works/employer', [
    'as'   => 'how-it-works-employer',
    'uses' => 'Frontend\HowItWorksEmployer\Controller@index',
]);
Route::get('pricing', [
    'as'   => 'pricing',
    'uses' => 'Frontend\Pricing\Controller@index',
]);

Route::post('contact-us', [
    'as'   => 'frontend.contact-us',
    'uses' => 'Frontend\Contactus\Controller@post',
]);
Route::get('schedule-meeting', [
    'as'   => 'frontend.schedule-meeting',
    'uses' => 'Frontend\Contactus\Controller@schedule',
]);

Route::get('candidate', function () {
    return view('frontend.candidate.index');
});

Route::group(['prefix' => 'brand-admin', 'namespace' => 'BrandAdmin', 'as' => 'brand-admin.'], function () {
    Route::get('dashboard', [
        'as'   => 'dashboard',
        'uses' => 'DashboardController@index',
    ]);

    Route::get('unsuccessful-candidates', [
        'as'   => 'unsuccessful-candidates',
        'uses' => 'UnsuccessfulCandidatesController@index',
    ]);

    Route::any('unsuccessful-candidates-data', [
        'as'   => 'unsuccessful-candidates.data',
        'uses' => 'UnsuccessfulCandidatesController@anyData',
    ]);

    Route::get('live-candidates', [
        'as'   => 'live-candidates',
        'uses' => 'LiveCandidatesController@index',
    ]);

    Route::any('live-candidates-data', [
        'as'   => 'live-candidates.data',
        'uses' => 'LiveCandidatesController@anyData',
    ]);

    Route::get('cv-processing', [
        'as'   => 'cv-processing',
        'uses' => 'CvProcessingController@index',
    ]);

    Route::any('cv-processing-data', [
        'as'   => 'cv-processing.data',
        'uses' => 'CvProcessingController@anyData',
    ]);

    Route::get('cv-requests', [
        'as'   => 'cv-requests',
        'uses' => 'CvRequestsController@index',
    ]);

    Route::any('cv-requests-data', [
        'as'   => 'cv-requests.data',
        'uses' => 'CvRequestsController@anyData',
    ]);

    Route::any('cv-download/{candidateId}', [
        'as'   => 'cv-download',
        'uses' => 'CvProcessingController@downloadCv',

    ]);

    Route::get('law-firms', [
        'as'   => 'law-firms',
        'uses' => 'LawFirmsController@index',
    ]);

    Route::any('law-firms-data', [
        'as'   => 'law-firms.data',
        'uses' => 'LawFirmsController@anyData',
    ]);

    Route::get('law-firms/create', [
        'as'   => 'law-firms.create',
        'uses' => 'LawFirmsController@create',
    ]);

    Route::post('law-firms', [
        'as'   => 'law-firms.store',
        'uses' => 'LawFirmsController@store',
    ]);

    Route::get('law-firms/{lawFirm}/edit', [
        'as'   => 'law-firms.edit',
        'uses' => 'LawFirmsController@edit',
    ]);

    Route::put('law-firms/{lawFirm}', [
        'as'   => 'law-firms.update',
        'uses' => 'LawFirmsController@update',
    ]);

    Route::delete('law-firms/{lawFirm}', [
        'as'   => 'law-firms.destroy',
        'uses' => 'LawFirmsController@destroy',
    ]);

    Route::get('candidates', [
        'as'   => 'candidates',
        'uses' => 'CandidatesController@index',
    ]);

    Route::any('candidates-data', [
        'as'   => 'candidates.data',
        'uses' => 'CandidatesController@anyData',
    ]);

    Route::get('candidates/{id}/toggle-live-status', [
        'as'   => 'candidates.toggleLiveStatus',
        'uses' => 'CandidatesController@toggleLiveStatus',
    ]);

    Route::get('candidates/{id}/login', [
        'as'   => 'candidates.login',
        'uses' => 'CandidatesController@login',
    ]);

    Route::delete('candidates/{id}', [
        'as'   => 'candidates.destroy',
        'uses' => 'CandidatesController@destroy',
    ]);

    Route::patch('searches/{id}/update', [
        'as'   => 'search.update',
        'uses' => 'SearchesController@update',
    ]);

    Route::get('hirers', [
        'as'   => 'hirers',
        'uses' => 'HirersController@index',
    ]);

    Route::any('hirers-data', [
        'as'   => 'hirers.data',
        'uses' => 'HirersController@anyData',
    ]);

    Route::get('hirers/{id}/login', [
        'as'   => 'hirers.login',
        'uses' => 'HirersController@login',
    ]);

    Route::get('failed-hirer-registration/{failedRegistration}/approve', [
        'as'   => 'failed-hirer-registration.approve',
        'uses' => 'FailedHirerRegistrationController@approve',
    ]);

    Route::get('change-password', [
        'as'   => 'password.change',
        'uses' => 'ChangePasswordController@index',
    ]);

    Route::post('change-password', [
        'as'   => 'password.change',
        'uses' => 'ChangePasswordController@store',
    ]);
});

Route::group(['prefix' => 'employer', 'namespace' => 'Hirer', 'as' => 'hirer.'], function () {
    Route::get('register', [
        'as'   => 'register',
        'uses' => 'RegisterController@index',
    ]);

    Route::post('register', [
        'as'   => 'register',
        'uses' => 'RegisterController@store',
    ]);

    Route::get('dashboard', [
        'as'   => 'dashboard',
        'uses' => 'DashboardController@index',
    ]);

    Route::group(['prefix' => 'search', 'as' => 'search.', 'namespace' => 'Search'], function () {
        Route::get('create/vacancy-details', [
            'as'   => 'vacancydetails',
            'uses' => 'VacancyDetails\Create\VacancyDetailsController@index',
        ]);

        Route::post('create/vacancy-details', [
            'as'   => 'vacancydetails',
            'uses' => 'VacancyDetails\Create\VacancyDetailsController@store',
        ]);

        Route::get('edit/vacancy-details/{id}', [
            'as'   => 'vacancydetails.edit',
            'uses' => 'VacancyDetails\Update\VacancyDetailsController@show',
        ]);

        Route::post('edit/vacancy-details/{id}', [
            'as'   => 'vacancydetails.edit',
            'uses' => 'VacancyDetails\Update\VacancyDetailsController@store',
        ]);

        Route::get('create/candidate-filters', [
            'as'   => 'candidatefilters',
            'uses' => 'CandidateFilters\Create\CandidateFiltersController@index',
        ]);

        Route::post('create/candidate-filters', [
            'as'   => 'candidatefilters',
            'uses' => 'CandidateFilters\Create\CandidateFiltersController@store',
        ]);

        Route::get('edit/candidate-filters/{id}', [
            'as'   => 'candidatefilters.edit',
            'uses' => 'CandidateFilters\Update\CandidateFiltersController@show',
        ]);

        Route::post('edit/candidate-filters/{id}', [
            'as'   => 'candidatefilters.edit',
            'uses' => 'CandidateFilters\Update\CandidateFiltersController@store',
        ]);

        Route::get('edit/delete/{id}', [
            'as'   => 'delete',
            'uses' => 'Delete\DeleteController@post',
        ]);

        Route::get('results', [
            'as'   => 'search-results',
            'uses' => 'Results\ResultsController@index',
        ]);

        Route::post('save', [
            'as'   => 'save',
            'uses' => 'Save\SaveController@save',
        ]);

        Route::any('data', [
            'as'   => 'search-results.data',
            'uses' => 'Results\ResultsController@anyData',
        ]);
    });

    Route::get('searches/{search}/results', [
        'as'   => 'search.results',
        'uses' => 'ResultsController@index',
    ]);

    Route::patch('searches/{search}/request', [
        'as'   => 'search.results.request',
        'uses' => 'ResultsController@update',
    ]);

    Route::patch('searches/{search}/viewed', [
        'as'   => 'search.results.viewed',
        'uses' => 'ResultsController@viewed',
    ]);

    Route::any('searches/{search}/results-data', [
        'as'   => 'search.results.data',
        'uses' => 'ResultsController@anyData',
    ]);

    Route::get('searches', [
        'as'   => 'search.savedsearches',
        'uses' => 'SavedSearchesController@index',
    ]);

    Route::any('searches-data', [
        'as'   => 'search.savedsearches.data',
        'uses' => 'SavedSearchesController@anyData',
    ]);

    Route::get('unsuccessful-candidates', [
        'as'   => 'unsuccessful-candidates',
        'uses' => 'UnsuccessfulCandidatesController@index',
    ]);

    Route::any('unsuccessful-candidates-data', [
        'as'   => 'unsuccessful-candidates.data',
        'uses' => 'UnsuccessfulCandidatesController@anyData',
    ]);

    Route::get('live-candidates', [
        'as'   => 'live-candidates',
        'uses' => 'LiveCandidatesController@index',
    ]);

    Route::any('live-candidates-data', [
        'as'   => 'live-candidates.data',
        'uses' => 'LiveCandidatesController@anyData',
    ]);

    Route::get('cv-requests', [
        'as'   => 'cv-requests',
        'uses' => 'CvRequestsController@index',
    ]);

    Route::any('cv-requests-data', [
        'as'   => 'cv-requests.data',
        'uses' => 'CvRequestsController@anyData',
    ]);

    Route::get('change-password', [
        'as'   => 'password.change',
        'uses' => 'ChangePasswordController@index',
    ]);

    Route::post('change-password', [
        'as'   => 'password.change',
        'uses' => 'ChangePasswordController@store',
    ]);

    Route::get('edit-details', [
        'as'   => 'details.edit',
        'uses' => 'EditDetailsController@index',
    ]);

    Route::post('edit-details', [
        'as'   => 'details.store',
        'uses' => 'EditDetailsController@store',
    ]);
});

Route::group(['prefix' => 'candidate', 'namespace' => 'Candidate', 'as' => 'candidate.'], function () {
    Route::get('register', [
        'as'   => 'register',
        'uses' => 'RegisterController@index',
    ]);

    Route::post('register', [
        'as'   => 'register',
        'uses' => 'RegisterController@store',
    ]);

    Route::get('change-password', [
        'as'   => 'password.change',
        'uses' => 'ChangePasswordController@index',
    ]);

    Route::post('change-password', [
        'as'   => 'password.change',
        'uses' => 'ChangePasswordController@store',
    ]);

    Route::post('delete-request', [
        'as'   => 'delete.request',
        'uses' => 'RequestDeleteController@store',
    ]);

    Route::get('dashboard', [
        'as'   => 'dashboard',
        'uses' => 'DashboardController@index',
    ]);

    Route::get('unsuccessful-vacancies', [
        'as'   => 'unsuccessful-vacancies',
        'uses' => 'UnsuccessfulVacanciesController@index',
    ]);

    Route::any('unsuccessful-vacancy-data', [
        'as'   => 'unsuccessful-vacancies.data',
        'uses' => 'UnsuccessfulVacanciesController@anyData',
    ]);

    Route::get('live-vacancies', [
        'as'   => 'live-vacancies',
        'uses' => 'LiveVacanciesController@index',
    ]);

    Route::any('live-vacancy-data', [
        'as'   => 'live-vacancies.data',
        'uses' => 'LiveVacanciesController@anyData',
    ]);

    Route::get('cv-requests-pending', [
        'as'   => 'cv-requests-pending',
        'uses' => 'CVRequestsPendingController@index',
    ]);

    Route::patch('cv-requests-pending/{id}', [
        'as'   => 'cv-requests-pending.update',
        'uses' => 'CVRequestsPendingController@update',
    ]);

    Route::get('cv-requests-pending-email/{id}', [
        'as'   => 'cv-requests-pending.email',
        'uses' => 'CVRequestsPendingController@email',
    ]);

    Route::any('cv-requests-pending-data', [
        'as'   => 'cv-requests-pending.data',
        'uses' => 'CVRequestsPendingController@anyData',
    ]);

    Route::any('type-of-firm-option-data', [
        'as'   => 'type-of-firm-option.data',
        'uses' => 'Account\Preferences\BasePreferencesController@typeOfFirmOptionData',
    ]);

    Route::group(['prefix' => 'register', 'as' => 'register', 'namespace' => 'Account'], function () {
        Route::get('details', ['as' => '.details', 'uses' => 'Details\Register\DetailsController@index']);
        Route::post('details', ['as' => '.details', 'uses' => 'Details\Register\DetailsController@store']);

        Route::get('cv', ['as' => '.cv', 'uses' => 'Cv\Register\CvController@index']);
        Route::post('cv', ['as' => '.cv', 'uses' => 'Cv\Register\CvController@store']);

        Route::get('your-profile', ['as' => '.your-profile', 'uses' => 'Profile\Register\ProfileController@index']);
        Route::post('your-profile', ['as' => '.your-profile', 'uses' => 'Profile\Register\ProfileController@store']);

        Route::get('preferences', ['as' => '.preferences', 'uses' => 'Preferences\Register\PreferencesController@index']);
        Route::post('preferences', ['as' => '.preferences', 'uses' => 'Preferences\Register\PreferencesController@store']);

        Route::get('review', ['as' => '.review', 'uses' => 'ReviewController@index']);
        Route::post('review', ['as' => '.review', 'uses' => 'ReviewController@store']);
    });


    Route::group(['prefix' => 'profile', 'as' => 'profile', 'namespace' => 'Account'], function () {
        Route::get('/', ['uses' => 'ViewProfileController@index']);
        Route::get('details', ['as' => '.details', 'uses' => 'Details\Edit\DetailsController@index']);
        Route::post('details', ['as' => '.details', 'uses' => 'Details\Edit\DetailsController@store']);

        Route::get('cv', ['as' => '.cv', 'uses' => 'Cv\Edit\CvController@index']);
        Route::post('cv', ['as' => '.cv', 'uses' => 'Cv\Edit\CvController@store']);

        Route::get('your-profile', ['as' => '.your-profile', 'uses' => 'Profile\Edit\ProfileController@index']);
        Route::post('your-profile', ['as' => '.your-profile', 'uses' => 'Profile\Edit\ProfileController@store']);

        Route::get('preferences', ['as' => '.preferences', 'uses' => 'Preferences\Edit\PreferencesController@index']);
        Route::post('preferences', ['as' => '.preferences', 'uses' => 'Preferences\Edit\PreferencesController@store']);
    });
});
