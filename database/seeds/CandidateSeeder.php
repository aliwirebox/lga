<?php

use App\Models\Candidate;
use App\Models\Language;
use App\Models\LawFirmBand;
use App\Models\Location;
use App\Models\TrainingSeat;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    protected $languageList;
    protected $deparmentList;
    protected $lawFirmBandList;
    protected $trainingSeatList;
    protected $locationList;

    public function run()
    {
        $this->truncateTables();
        $this->loadManyToManyRelationships();
        $faker = App::make('Faker\Generator');

        //create 40 pre-live candidates with validated emails
        for ($i = 1; $i < 41; $i++) {
            $candidate = Candidate::create([
                'first_name' => $faker->firstName(),
                'last_name'  => $faker->lastName,
                'email'      => "brand-candidate-$i@example.org",
                'password'   => bcrypt('testpass'),
            ]);

            $candidate->verifyEmail();
        }

        //create know live test candidate
        $candidate = factory(Candidate::class)->create([
            'first_name' => 'Test',
            'last_name'  => 'Candidate',
            'email'      => 'candidate@test.com',
            'password'   => bcrypt('testpass'),
        ]);

        $this->setManyToManyRelationships($candidate);
        $this->createCv($candidate);

        //create bulk set of random live candidates
        factory(Candidate::class, 10)->create([
            'password' => bcrypt('testpass'),
        ])->each(function ($candidate) {
            $this->setManyToManyRelationships($candidate);
            $this->createCv($candidate);
        });
    }

    protected function truncateTables()
    {
        Candidate::truncate();
        DB::table('candidate_language')->truncate();
        DB::table('candidate_department')->truncate();
        DB::table('candidate_law_firm_band')->truncate();
        DB::table('candidate_training_seat')->truncate();
        DB::table('candidate_location')->truncate();
    }

    protected function loadManyToManyRelationships()
    {
        $this->languageList = Language::all();
        $this->deparmentList = TrainingSeat::all();
        $this->trainingSeatList = TrainingSeat::all();
        $this->locationList = Location::with('bands')->get();
    }

    protected function setManyToManyRelationships($candidate)
    {
        $numberOfLanguages = random_int(0, 5);
        $numberOfDeparments = random_int(2, 20);
        $numberOfTrainingSeats = random_int(4, 8);
        $numberOfLocations = random_int(2, 8);

        /*
         * The following code below chains the laravel collection functions. The laravel random function only returns a collection
         * if its argument is a integer of 2 or more.
         */
        if ($numberOfLanguages > 1) {
            $languageIdList = $this->languageList->random($numberOfLanguages)->pluck('id')->toArray();
            $candidate->languages()->attach($languageIdList);
        }

        $deparmentIdList = $this->deparmentList->random($numberOfDeparments)->pluck('id')->toArray();
        $candidate->preferedDepartments()->attach($deparmentIdList);

        $trainingSeatIdList = $this->trainingSeatList->random($numberOfTrainingSeats)->pluck('id')->toArray();
        $candidate->trainingSeats()->attach($trainingSeatIdList);

        $locationIdList = $this->locationList->random($numberOfLocations)->pluck('id')->toArray();
        $candidate->preferedlocations()->attach($locationIdList);

        $possibleLawFirmBandList = $candidate->preferedlocations->map(function ($location) {
            return $location->bands()->with('parent')->get();
        })->flatten(1)
          ->keyBy('id');

        $numberOfLawFirmBands = random_int(2, $possibleLawFirmBandList->count());
        $lawFirmBandList = $possibleLawFirmBandList->random($numberOfLawFirmBands);

        /*
         * its important for the display of the type of firm drop down that all the parents of any of the
         * child bands are attched. Otherwise the dropdwon will not display the select children
         */
        $parentLawFirmBandList = $lawFirmBandList->map(function ($band) {
            return $band->parent;
        })->pluck('id')
          ->filter(function ($bandId) {
              return is_numeric($bandId);
          })->toArray();

        $lawFirmBandList = $lawFirmBandList->pluck('id')->merge($parentLawFirmBandList)->unique()->toArray();
        $candidate->preferedLawFirmBands()->attach($lawFirmBandList);
    }

    protected function createCv($candidate)
    {
        $fileContents = file_get_contents(database_path('seeds/files/cv.pdf'));

        Storage::disk('candidate-cvs')->put($candidate->id, $fileContents);
    }
}
