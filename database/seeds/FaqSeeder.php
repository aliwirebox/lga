<?php

use Illuminate\Database\Seeder;

use Yab\Quarx\Models\FAQ;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FAQ::truncate();

        factory(FAQ::class, 15)->create();
    }
    
}
