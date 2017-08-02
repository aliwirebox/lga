<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        /*
         * Only add seeds that create the basic data required
         * for the application to run.
         */
        $this->call(LawFirmBandTableSeeder::class);
        $this->call(LawFirmTableSeeder::class);
        $this->call(TrainingSeatsTableSeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(NqLawFirmSeeder::class);
        $this->call(OptionLawFirmSeeder::class);
        $this->call(LocationSeeder::class);
    }
}
