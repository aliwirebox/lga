<?php

use Illuminate\Database\Seeder;
use App\Models\Hirer;
use App\Models\LawFirmBand;


class LawFirmBandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hirer::truncate();
        LawFirmBand::truncate();

        $reader = \League\Csv\Reader::createFromPath('database/csv/list-of-top-ranked-and-generic-bands.csv');
        $reader->setDelimiter(',');
        $results = $reader->fetch();


        foreach ($results as $row) {
            if ($row[1] == "null") {
                $parent_id = null;
            } else {
                $parent_id = $row[1];
            }

            if (strcmp($row[0],"US Firms") == 1) {
                $name = "All US Firms";
            } else {
                $name = $row[0];
            }


            $rank = (is_numeric($row[2]) ? $row[2] : 0);
            $order = (is_numeric($row[3]) ? $row[3] : 0);

            LawFirmBand::create(
                [
                    'name'      => $name,
                    'rank'      => $rank,
                    'order'     => $order,
                    'parent_id' => $parent_id,
                    'is_option' => 0,
                ]
            );

        }
    }
}
