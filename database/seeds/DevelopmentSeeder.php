<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    public function run()
    {
        /*
         * This will run base seeder then addional dummy
         * data seeds
         */
        $this->call(DatabaseSeeder::class);
        $this->call(BlogImageSeeder::class);
        $this->call(BlogCategorySeeder::class);
        $this->call(BlogPostsSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(CandidateSeeder::class);
        $this->call(HirerSeeder::class);
        $this->call(BrandAdminSeeder::class);
        $this->call(SearchSeeder::class);
        $this->call(FakeSearchResultsSeeder::class);
    }
}
