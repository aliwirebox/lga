<?php

use Illuminate\Database\Seeder;
use App\Models\TrainingSeat;

class TrainingSeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrainingSeat::truncate();
        $reader = \League\Csv\Reader::createFromPath('database/csv/list-of-training-seats.csv');
        $reader->setDelimiter(';');
        $results = $reader->fetch();
        
        foreach ($results as $row) {
            TrainingSeat::create(
                [
                    'name' => $row[0],
                ]
            );
        }
    }
}
