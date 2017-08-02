<?php

use App\Models\LawFirm;
use App\Models\LawFirmBand;
use App\Models\Hirer;
use Illuminate\Database\Seeder;

class NqLawFirmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hirer::truncate();

        LawFirm::all()->each(function ($firm) {
            $hirer = factory(Hirer::class)->create([
                'first_name' => 'NQ',
                'last_name' => 'Admin',
                'email' => str_slug($firm->name) . '@nqsolicitors.com',
                'password' => '', //leave blank so you have to login as an admin to access these accounts
                'law_firm_id' => $firm->id,
            ]);
        });
    }
}
