<?php

use Illuminate\Database\Seeder;

use App\Models\Quarx\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::truncate();

        factory(Faq::class, 15)->create();
    }
    
}
