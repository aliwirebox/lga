<?php

use App\Models\Hirer;
use Illuminate\Database\Seeder;

class HirerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create know test hirer
        factory(Hirer::class)->create([
            'first_name'  => 'Test',
            'last_name'   => 'Hirer',
            'email'       => 'hirer@test.com',
            'password'    => bcrypt('testpass'),
            'law_firm_id' => 1,
        ]);
    }
}
