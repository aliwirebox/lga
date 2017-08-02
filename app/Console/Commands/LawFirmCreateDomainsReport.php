<?php

namespace App\Console\Commands;

use App\Models\LawFirm;
use Illuminate\Console\Command;
use League\Csv\Writer;

class LawFirmCreateDomainsReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'law-firm:create-domains-report {csv : Path to output CSV}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports all law firms and their domains to a CSV.';

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
        $csvPath = $this->argument('csv');

        $csvRows = LawFirm::with('domains')
            ->get()
            ->transform(function ($firm) {
                return $firm->domains
                    ->pluck('name')
                    ->prepend($firm->name);
            })
            ->prepend([
                'Law Firm',
                'Recognised E-mail Address'
            ]);

        $writer = Writer::createFromPath($csvPath, 'w+');
        $writer->insertAll($csvRows->toArray());
    }
}
