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

        $data = $this->getLocationData();
        
        $this->addChildren($data, -1);
    }

    public function addChildren($data, $parentColumnIndex, $parent = null)
    {
        $columnIndex = $parentColumnIndex + 1;

        foreach ($data as $rowIndex => $row) {
            if ($this->isNewParent($row, $parentColumnIndex, $parent)) {
                return true;
            }

            if (!empty($row[$columnIndex])) {
                $location = Location::create([
                    'name'      => $row[$columnIndex],
                    'parent_id' => $parent ? $parent->id : null,
                ]);

                $this->addChildren(array_slice($data, $rowIndex), $columnIndex, $location);
            }
        }
    }

    protected function getLocationData()
    {
        $data = Reader::createFromPath(database_path('csv/locations.csv'));

        $data = iterator_to_array($data);
    
        array_shift($data);

        return $data;
    }

    public function isNewParent($row, $parentColumnIndex, $parent = null)
    {
        return $parent && !empty($row[$parentColumnIndex]) && $row[$parentColumnIndex] != $parent->name;
    }

    protected function truncateTables()
    {
        Location::truncate();
    }
}
