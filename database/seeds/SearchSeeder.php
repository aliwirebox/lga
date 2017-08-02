<?php

use App\Models\Hirer;
use App\Models\Language;
use App\Models\LawFirmBand;
use App\Models\Search;
use App\Models\TrainingSeat;
use App\Models\UniversityBand;
use Illuminate\Database\Seeder;

class SearchSeeder extends Seeder
{
    protected $languageList;
    protected $lawFirmBandList;
    protected $trainingSeatList;
    protected $universityBandList;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();
        $this->loadManyToManyRelationships();

        Hirer::all()->each(function($hirer){
            $this->createSearches($hirer);  
        });
    }

    protected function createSearches($hirer)
    {
        factory(Search::class, random_int(2, 5))->create([
            'hirer_id' => $hirer->id, 
        ])->each(function($search) {
            $this->setManyToManyRelationships($search);
//            $search->updateMatches();
        });
    }

    protected function setManyToManyRelationships($search)
    {
        $numberOfLanguages = random_int(0, 3);
        $numberOfTrainingSeats = random_int(0, 8);
        $numberOfUniBands = random_int(0, 30);
        $numberOfLawFirmBands = random_int(0, 50);

        /*
         * The following code below chains the laravel collection functions. The laravel random function only returns a collection
         * if its argument is a integer of 2 or more. 
         */
        if ($numberOfLanguages > 1) {
            $languageIdList = $this->languageList->random($numberOfLanguages)->pluck('id')->toArray();
            $search->languages()->attach($languageIdList);
        }

        if ($numberOfTrainingSeats > 1) {
            $trainingSeatIdList = $this->trainingSeatList->random($numberOfTrainingSeats)->pluck('id')->toArray();
            $search->trainingSeats()->attach($trainingSeatIdList);
        }

        if ($numberOfUniBands > 1) {
            $universityBandIdList = $this->trainingSeatList->random($numberOfUniBands)->pluck('id')->toArray();
            $search->universityBands()->attach($universityBandIdList);
        }

        if ($numberOfLawFirmBands > 1) {
            $lawFirmBandIdList = $this->lawFirmBandList->random($numberOfLawFirmBands)->pluck('id')->toArray();
            $search->trainingLawFirmBands()->attach($lawFirmBandIdList);
        }
    }

    protected function loadManyToManyRelationships()
    {
        $this->languageList = Language::all();
        $this->lawFirmBandList = LawFirmBand::all();
        $this->trainingSeatList = TrainingSeat::all();
        $this->universityBandList = UniversityBand::all();
    }

    protected function truncateTables()
    {
        Search::truncate();
        DB::table('candidate_search')->truncate();
        DB::table('language_search')->truncate();
        DB::table('law_firm_band_search')->truncate();
        DB::table('search_training_seat')->truncate();
        DB::table('search_university_band')->truncate();
    }
}
