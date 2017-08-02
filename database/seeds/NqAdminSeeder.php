<?php

use App\Models\NqAdmin;
use Illuminate\Database\Seeder;

class NqAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NqAdmin::truncate();

        //create know test NQ admin
        factory(NqAdmin::class)->create([
            'first_name' => 'Test',
            'last_name' => 'NqAdmin',
            'email' => 'nq-admin@test.com',
            'password' => bcrypt('testpass'), 
        ]);
    }
}