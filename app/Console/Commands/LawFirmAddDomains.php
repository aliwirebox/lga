<?php

namespace App\Console\Commands;

use App\Models\Hirer;
use App\Models\LawFirm;
use App\Models\LawFirmBand;
use App\Models\LawFirmDomain;
use Illuminate\Console\Command;
use League\Csv\Reader;

class LawFirmAddDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'law-firm:add-domains {csv : Path to domain CSV}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Adds additional domains to a law firm. Will also create a law firm if it doesn't already exist.";

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

        $csv = Reader::createFromPath($csvPath);
        $csv->setOffset(1); //because we don't want to insert the header

        foreach ($csv->fetch() as $row) {
            $lawFirm = LawFirm::whereName(trim($row[0]))->first();

            if (!$lawFirm) {
                $lawFirm = $this->setupNewLawFirm($row);
            } else {
                echo "Found {$lawFirm->name} \n";
            }

            unset($row[0]); //unset name column

            foreach ($row as $column) {
                if (!empty($column)) {
                    $lawFirm->domains()->firstOrCreate(['name' => $column]);
                }
            }
        }
    }

    protected function setupNewLawFirm($row)
    {
        $lawFirm = LawFirm::create(['name' =>  trim($row[0])]);

        LawFirmBand::find(1)->lawFirm()->attach($lawFirm);

        factory(Hirer::class)->create([
            'first_name'  => config('brand.identity.initials'),
            'last_name'   => 'Admin',
            'email'       => str_slug($lawFirm->name) . config('brand.email.support'),
            'password'    => '', //leave blank so you have to login as an admin to access these accounts
            'telephone'   => '', //leave blank so admin pannel looks clean
            'law_firm_id' => $lawFirm->id,
        ]);

        $lawFirm->domains()->create(['name' => config('brand.email.domain')]);

        return $lawFirm;
    }
}
