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
        
        $locationNodes = [
            'name'     => 'International (Any)',
            'children' => $this->getChildren($data, -1),
        ];

        Location::create($locationNodes);
    }

    protected function getChildren($data, $parentColumnIndex, $parentName = '')
    {
        $columnIndex = $parentColumnIndex + 1;

        $children = [];

        foreach ($data as $rowIndex => $row) {
            if ($this->isNewParent($row, $parentColumnIndex, $parentName)) {
                return $children;
            }

            if (!empty($row[$columnIndex])) {
                $children[] = [
                    'name'     => $row[$columnIndex],
                    'children' => $this->getChildren(array_slice($data, $rowIndex), $columnIndex, $row[$columnIndex]),
                ];
            }
        }

        return $children;
    }

    protected function getLocationData()
    {
        $data = Reader::createFromPath(database_path('csv/locations.csv'));

        $data = iterator_to_array($data);
    
        array_shift($data);

        return $data;
    }

    public function isNewParent($row, $parentColumnIndex, $parentName = '')
    {
        return !empty($parentName) && !empty($row[$parentColumnIndex]) && $row[$parentColumnIndex] != $parentName;
    }

    protected function truncateTables()
    {
        Location::truncate();
    }
}
