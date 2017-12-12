<?php

use App\Models\TrainingSeat;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

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

        $reader = Reader::createFromPath('database/csv/list-of-training-seats.csv');
        
        foreach ($reader->fetch() as $row) {
            if (!TrainingSeat::whereName($row[0])->first()) {
                TrainingSeat::create([
                    'name'          => $row[0],
                    'is_department' => $row[1],
                ]);
            }
        }
    }
}
