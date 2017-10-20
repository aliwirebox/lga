<?php

namespace App\Console\Commands;

use App\Models\Search;
use Illuminate\Console\Command;
use Log;

class SearchUpdateMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:update-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-run all saved searches to update matches';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $searchList = Search::with(['vacancyLocation', 'trainingSeats'])->active()->get();

        Log::info("Search: started to update {$searchList->count()} searches from command line");

        $searchList->each(function ($search) {
            $updateDetails = $search->updateMatches();

            Log::info("Search: updated {$search->id} for {$search->hirer->email} from {$search->lawFirm()->name}", $updateDetails);
        });

        Log::info("Search: finished updating {$searchList->count()} searches from command line");
    }
}
