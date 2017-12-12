<?php

use App\Models\TrainingSeat;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

/*
 * This seeder requires departments to be listed first
 * and skills second. Because currently, all deparments
 * are skills and there are usually duplicates in the CSV
 */
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
