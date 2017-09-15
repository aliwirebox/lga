<?php

use App\Models\BrandAdmin;
use Illuminate\Database\Seeder;

class BrandAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BrandAdmin::truncate();

        //create know test BRAND admin
        factory(BrandAdmin::class)->create([
            'first_name' => 'Test',
            'last_name' => 'BrandAdmin',
            'email' => 'brand-admin@test.com',
            'password' => bcrypt('testpass'), 
        ]);
    }
}
