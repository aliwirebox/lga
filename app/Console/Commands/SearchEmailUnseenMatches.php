<?php

namespace App\Console\Commands;

use App\Models\Search;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;
use Mail;

class SearchEmailUnseenMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:email-unseen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email unseen matches alert to hirers';

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
        Log::info("Search: started emailing unseen matches from command line");

        $searchList = Search::with(['matches' => function ($query) {
            $query->where('candidate_search.hirer_viewed', 0)
                ->where('candidate_search.created_at', '>', Carbon::now()->subDay());
        }])->active()->get();

        $searchList->each(function ($search) {
            if ($search->matches->count() > 0) {
                Log::info("Search: sending email to {$search->hirer->email} about {$search->matches->count()} unseen matches in {$search->id}");

                $hirer = $search->hirer;

                Mail::send('app.emails.automated-matches-email-hirer', compact('search', 'hirer'), function ($message) use ($search) {
                    $message->from(config('brand.email.employment'));
                    $message->subject('New Matches for your Saved Search:');
                    $message->to($search->hirer->email);
                    $message->bcc(config('brand.email.employment'));
                });
            }
        });

        Log::info("Search: finished emailing unseen matches from command line");
    }
}
