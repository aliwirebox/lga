<?php

use App\Models\LawFirmBand;
use App\Models\Location;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();

        $london = Location::create(['name' => 'London']); //make sure london is id 1 for testing

        $bands = $this->getBands();

        $this->getLocationData()->each(function ($data) use ($bands) {
            $bandIds = [1]; // "All Law Firms" band

            foreach ($data as $key => $value) {
                if ($value === '*') {
                    array_push($bandIds, $bands[$key]->id);
                }
            }

            $locationName = array_shift($data);

            Location::create(['name' => $locationName])
                ->bands()
                ->sync($bandIds);
        });

        /** Sync all other bands (ie the original bands) to London **/

        $bandIds = LawFirmBand::with('locations')->get()
            ->filter(function ($band) {
                return $band->locations->count() == 0;
            })->pluck('id')->toArray();

        array_push($bandIds, 1); // "All Law Firms" band

        $london->bands()->sync($bandIds);
    }

    public function getBands()
    {
        $data = $this->getCsvData();

        $bands = collect($data->shift());

        $bands = $bands->slice(1); //this function perserves keys which is important to later match the * to the correct band

        $bands->transform(function ($bandName) {
            return LawFirmBand::whereName($bandName)->firstOrFail();
        });

        return $bands;
    }

    public function getCsvData()
    {
        $data = Reader::createFromPath(database_path('csv/locations.csv'));

        return collect(iterator_to_array($data));
    }

    public function getLocationData()
    {
        $data = $this->getCsvData();

        $data->shift();

        return $data;
    }

    public function truncateTables()
    {
        Location::truncate();

        DB::table('law_firm_band_location')->truncate();
    }
}
