var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.styles([
        'typography.css',
        'main.css'
    ], 'public/css/main.css');

    mix.styles([
        'app.css'
    ], 'public/css/app.css');

    mix.scripts([
        'main.scripts.js'
    ], 'public/js/main.scripts.js');

    mix.scripts([
        'candidate-preferences.js'
    ], 'public/js/candidate-preferences.js');

    mix.scripts([
        'dropdown.js'
    ], 'public/js/dropdown.js');

    mix.scripts([
        'items-popup.js'
    ], 'public/js/items-popup.js');

    mix.scripts([
        'additional-information-popup.js'
    ], 'public/js/additional-information-popup.js');

    mix.scripts([
        'referral-candidate-popup.js'
    ], 'public/js/referral-candidate-popup.js');

    mix.scripts([
        'save-popup.js'
    ], 'public/js/save-popup.js');

    mix.scripts([
        'ucas-points-popup.js'
    ], 'public/js/ucas-points-popup.js');

    mix.scripts([
        'candidate-cv.js'
    ], 'public/js/candidate-cv.js');

    mix.scripts([
        'candidate-profile.js'
    ], 'public/js/candidate-profile.js');

    mix.scripts([
        'candidate-profile-table.js'
    ], 'public/js/candidate-profile-table.js');

    mix.scripts([
        'candidate-unsuccessful-vacancies-table.js'
    ], 'public/js/candidate-unsuccessful-vacancies-table.js');

    mix.scripts([
        'candidate-live-vacancies-table.js'
    ], 'public/js/candidate-live-vacancies-table.js');
    
    mix.scripts([
        'candidate-cv-requests-pending-table.js'
    ], 'public/js/candidate-cv-requests-pending-table.js');

    mix.scripts([
        'candidate-cv-request-buttons.js'
    ], 'public/js/candidate-cv-request-buttons.js');

    mix.scripts([
        'hirer-unsuccessful-candidate-table.js'
    ], 'public/js/hirer-unsuccessful-candidate-table.js');

    mix.scripts([
        'hirer-live-candidate-table.js'
    ], 'public/js/hirer-live-candidate-table.js');

    mix.scripts([
        'hirer-cv-requests-table.js'
    ], 'public/js/hirer-cv-requests-table.js');

    mix.scripts([
        'hirer-matches-table.js'
    ], 'public/js/hirer-matches-table.js');

    mix.scripts([
        'hirer-searches-table.js'
    ], 'public/js/hirer-searches-table.js');

    mix.scripts([
        'hirer-vacancy-details.js'
    ], 'public/js/hirer-vacancy-details.js');

    mix.scripts([
        'hirer-candidate-filters.js'
    ], 'public/js/hirer-candidate-filters.js');

    mix.scripts([
        'hirer-registration-form.js'
    ], 'public/js/hirer-registration-form.js');

    mix.scripts([
        'brand-admin-candidate-table.js'
    ], 'public/js/brand-admin-candidate-table.js');

    mix.scripts([
        'brand-admin-cv-request-table.js'
    ], 'public/js/brand-admin-cv-request-table.js');

    mix.scripts([
        'brand-admin-cv-processing-table.js'
    ], 'public/js/brand-admin-cv-processing-table.js');

    mix.scripts([
        'brand-admin-dashboard.js'
    ], 'public/js/brand-admin-dashboard.js');

    mix.scripts([
        'brand-admin-hirer-table.js'
    ], 'public/js/brand-admin-hirer-table.js');

    mix.scripts([
        'brand-admin-live-candidate-table.js'
    ], 'public/js/brand-admin-live-candidate-table.js');

    mix.scripts([
        'brand-admin-unsuccessful-candidate-table.js'
    ], 'public/js/brand-admin-unsuccessful-candidate-table.js');

    mix.scripts([
        'jquery.cookiebar.js'
    ], 'public/js/jquery.cookiebar.js');

    mix.version([
        'public/css/app.css',
        'public/css/main.css',
        'public/js/main.scripts.js',
        'public/js/dropdown.js',
        'public/js/items-popup.js',
        'public/js/additional-information-popup.js',
        'public/js/referral-candidate-popup.js',
        'public/js/save-popup.js',
        'public/js/ucas-points-popup.js',
        'public/js/candidate-preferences.js',
        'public/js/candidate-cv.js',
        'public/js/candidate-profile.js',
        'public/js/candidate-profile-table.js',
        'public/js/candidate-unsuccessful-vacancies-table.js',
        'public/js/candidate-live-vacancies-table.js',
        'public/js/candidate-cv-requests-pending-table.js',
        'public/js/candidate-cv-request-buttons.js',
        'public/js/hirer-unsuccessful-candidate-table.js',
        'public/js/hirer-live-candidate-table.js',
        'public/js/hirer-cv-requests-table.js',
        'public/js/hirer-matches-table.js',
        'public/js/hirer-searches-table.js',
        'public/js/hirer-vacancy-details.js',
        'public/js/hirer-candidate-filters.js',
        'public/js/hirer-registration-form.js',
        'public/js/brand-admin-candidate-table.js',
        'public/js/brand-admin-cv-request-table.js',
        'public/js/brand-admin-cv-processing-table.js',
        'public/js/brand-admin-dashboard.js',
        'public/js/brand-admin-hirer-table.js',
        'public/js/brand-admin-live-candidate-table.js',
        'public/js/brand-admin-unsuccessful-candidate-table.js',
        'public/js/jquery.cookiebar.js'
    ]);
});
