<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\BaseUser::class, function (Faker\Generator $faker) {
    return [
        'first_name'     => $faker->firstName(),
        'last_name'      => $faker->lastName,
        'email'          => uniqid() . $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Candidate::class, function (faker\generator $faker) use ($factory) {
    $baseUser = $factory->raw(App\Models\BaseUser::class);
    $uniId = App\Models\University::all()->random()->id;
    $lawFirmList = App\Models\LawFirm::all()->random(2);
    $role = App\Models\Role::all()->random(1);
    $degreeClass = config('degree-class.candidate-options');
    $salaryOptions = array_keys(config('salary-map.candidate-options'));
    unset($degreeClass[0]); //candidates can't have the option of "any"

    return array_merge($baseUser, [
        'cv_name'                          => 'my_cv.pdf',
        'cv_size'                          => 10000,
        'email_verified'                   => true,
        'telephone'                        => $faker->mobileNumber(),
        'is_live'                          => true,
        'role_id'                          => $role->id,
        'ucas_points'                      => $faker->numberBetween(0, 820),
        'university_id'                    => $uniId,
        'degree_class'                     => $faker->randomElement(array_keys($degreeClass)),
        'training_law_firm_id'             => $lawFirmList->pop()->id,
        'taken_client_secondment'          => $faker->boolean,
        'date_qualified'                   => $faker->dateTimeBetween('-18 months', '+24 months')->modify('first day of this month')->format('Y-m-d'),
        'current_law_firm_id'              => $lawFirmList->pop()->id,
        'did_training_firm_offer_position' => $faker->boolean,
        'minimum_salary'                   => $faker->randomElement($salaryOptions),
        'available_date'                   => Carbon::today()->format('Y-m-d'),
    ]);
});

$factory->define(App\Models\Hirer::class, function (Faker\Generator $faker) use ($factory) {
    $baseUser = $factory->raw(App\Models\BaseUser::class);
    $lawFirm = App\Models\LawFirm::all()->random();

    return array_merge($baseUser, [
        'email_verified' => true,
        'law_firm_id'    => $lawFirm->id,
        'telephone'      => $faker->mobileNumber(),
        'email'          => uniqid() . config('brand.email.domain'),
    ]);
});

$factory->define(App\Models\FailedHirerRegistration::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'first_name'   => $faker->firstName(),
        'last_name'    => $faker->lastName,
        'telephone'    => $faker->mobileNumber(),
        'email'        => uniqid() . $faker->safeEmail,
        'password'     => bcrypt(str_random(10)),
        'add_law_firm' => $faker->company,
        'law_firm_id'  => null,
    ];
});

$factory->define(App\Models\BrandAdmin::class, function (Faker\Generator $faker) use ($factory) {
    $baseUser = $factory->raw(App\Models\BaseUser::class);

    return $baseUser;
});

$factory->define(App\Models\Search::class, function (faker\generator $faker) use ($factory) {
    $hirerId = factory(App\Models\Hirer::class)->create()->id;
    $trainingSeatId = App\Models\TrainingSeat::all()->random()->id;
    $locationId = App\Models\Location::all()->random()->id;
    $fromDateObject = $faker->dateTimeBetween('-18 months', '+11 months')->modify('first day of this month'); //leave one month from max 18 to allow for end date
    $fromDate = [null, $fromDateObject->format('Y-m-d')];
    $toDate = [null, $faker->dateTimeBetween($fromDateObject, '+12 months')->modify('first day of this month')->format('Y-m-d')];
    $degreeClass = array_keys(config('degree-class.search-options'));
    $salaryOptions = array_keys(config('salary-map.vacancy-options'));

    return [
        'name'                           => $faker->sentence($faker->numberBetween(1, 3)),
        'date_qualified_from'            => $faker->randomElement($fromDate),
        'date_qualified_to'              => $faker->randomElement($toDate),
        'hirer_id'                       => $hirerId,
        'min_ucas_points'                => $faker->numberBetween(0, 820),
        'min_degree_class'               => $faker->randomElement($degreeClass),
        'taken_client_secondment'        => $faker->boolean,
        'vacancy_additional_information' => $faker->realText(),
        'vacancy_salary'                 => $faker->randomElement($salaryOptions),
        'vacancy_department_id'          => $trainingSeatId,
        'vacancy_location_id'            => $locationId,
        'available_date'                 => Carbon::today()->format('Y-m-d'),
    ];
});

$factory->define(Quarx\Modules\Blogs\Models\Blog::class, function (Faker\Generator $faker) {
    return [
        'title'        => $faker->sentence(),
        'tags'         => implode(', ', $faker->words()),
        'entry'        => '<p>' . $faker->paragraph() . '</p>',
        'template'     => 'show',
        'is_published' => true,
        'author'       => $faker->name(),
        'url'          => $faker->slug,
        'published_at' => Carbon::now()->format('Y-m-d h:i:s'),
    ];
});

$factory->define(Quarx\Modules\Blogcategories\Models\Blogcategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(15),
        'url'  => $faker->slug,
    ];
});

$factory->define(App\Models\Quarx\Faq::class, function (Faker\Generator $faker) {
    return [
        'question'     => $faker->text(20),
        'answer'       => $faker->text(500),
        'is_published' => true,
        'published_at' => Carbon::now()->format('Y-m-d h:i:s'),
    ];
});

$factory->define(App\Models\Quarx\Image::class, function (Faker\Generator $faker) {
    return [
        'name'         => $faker->text(20),
        'alt_tag'      => $faker->text(20),
        'title_tag'    => $faker->text(20),
        'alt_tag'      => $faker->text(20),
        'is_published' => true,
        'tags'         => implode(', ', $faker->words()),
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($faker->numberBetween(1, 3)),
    ];
});

$factory->define(App\Models\Quarx\Page::class, function (Faker\Generator $faker) {
    return [
        'is_published'    => true,
        'seo_description' => $faker->sentence(),
        'seo_keywords'    => implode(', ', $faker->words()),
        'published_at'    => Carbon::now()->format('Y-m-d h:i:s'),
    ];
});
