<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Database\Seeder;

class FakeSearchResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hirer = Hirer::find(1);

        $search = $hirer->searches()->first();

        $search->matches()->sync([
            50, 
            51 => ['status' => 100],
            52 => ['status' => 200],
            53 => ['status' => 300],
            54 => ['status' => 400],
            55 => ['status' => 500],
            56 => ['status' => 600],
            57 => ['status' => 700],
        ]);

        Search::limit(8)->get()->each(function($search, $key) {
            $status = $key * 100;

            $search->matches()->sync([
                41 => ['status' => $status],
            ]);

            return true;
        });
    }
}
