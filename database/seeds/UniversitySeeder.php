<?php

use Illuminate\Database\Seeder;

use App\Models\University;
use App\Models\UniversityBand;
use League\Csv\Reader;

class UniversitySeeder extends Seeder
{
    protected $bandList = [
        0 => ['name' => 'Any UK University', 'rank' => 0, 'order' => 1],
        'csv/oxbridge-university-band.csv' => ['name' => 'Oxbridge', 'rank' => 25, 'order' => 5],
        'csv/russell-group-university-band.csv' => ['name' => 'Russell Group', 'rank' => 20, 'order' => 10],
        'csv/top-10-for-law-university-band.csv' => ['name' => 'Top 10 for Law', 'rank' => 15, 'order' => 15],
        'csv/top-30-for-law-university-band.csv' => ['name' => 'Top 30 for Law', 'rank' => 10, 'order' => 20],
        'csv/top-50-overall-university-band.csv' => ['name' => 'Top 50 Overall', 'rank' => 5, 'order' => 25],
    ];

    public function run()
    {
        University::truncate();
        UniversityBand::truncate();
        DB::table('university_university_band')->truncate();
        
        $this->getUniList('csv/universities.csv')->each(function ($uni) {
            University::create($uni);
        });

        $this->getBandList()->each(function ($bandData, $bandCsv) {
            $band = UniversityBand::create($bandData);

            $uniIdList = ($bandCsv) ? $this->getUniIdListFromCsv($bandCsv)
                                    : $this->getAllUniIdList();

            $band->universities()->sync($uniIdList);
        });
    }

    protected function getBandList()
    {
        return collect($this->bandList);
    }

    protected function getUniList($path)
    {
        $uniList = Reader::createFromPath(database_path($path))->fetchAssoc(['name']);

        return collect(iterator_to_array($uniList));
    }

    protected function getUniIdListFromCsv($path)
    {
        return $this->getUniList($path)->map(function ($uni) {
            return University::where($uni)->firstOrFail()->id;
        })->toArray();
    }

    protected function getAllUniIdList()
    {
        return University::all()->map(function ($uni) {
            return $uni->id;
        })->toArray();
    }
}
