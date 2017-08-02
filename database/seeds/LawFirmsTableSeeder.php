<?php

use App\Models\LawFirm;
use App\Models\LawFirmBand;
use App\Models\LawFirmDomain;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class LawFirmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();

        $reader = Reader::createFromPath('database/csv/recognised-law-firms-and-domain-names.csv');
        $reader->setOffset(1); //because we don't want to insert the header
        $results = $reader->fetch();

        foreach ($results as $row) {
            $lawfirm = LawFirm::create(['name' =>  trim($row[0])]);

            $lawfirm->domains()->create(['name' => '@nqsolicitors.com']);

            for ($i = 1; $i < count($row); $i++) {
                if ($row[$i] != "") {
                    $lawfirm->domains()->create(['name' => $row[$i]]);
                }
            }
        }

        $map_law_firm = config('law-firm-bands-import-map');
        $cvs_ranking_map = config('cvs-ranking-map');

        for ($j = 0; $j < count($cvs_ranking_map); $j++) {
            //echo "CSV: ".$cvs_ranking_map[$j]."\n";
            $reader2 = Reader::createFromPath($cvs_ranking_map[$j]);
            $results2 = $reader2->fetch();
            $count = 0;
            $count_firms_percsv = 0;
            $count_firms_notfound = 0;
            $count_firms_found = 0;
            $count_matches_firms_firm_bands = 0;
            $band = null;

            foreach ($results2 as $row) {
                if ($count == 0) {
                    for ($x = 1; $x < count($row); $x++) {
                        if (!isset($map_law_firm[$row[$x]])) {
                            print_r($row[$x]); //print if you can't key in map
                        }

                        $band[$x - 1] = LawFirmBand::where('name', $map_law_firm[$row[$x]])->get();

                        if ($band[$x - 1]->count() == 0) {
                            print_r([$map_law_firm[$row[$x]], $row[$x]]); //print if you can't find band
                        }
                    }
                    $count++;
                } else {
                    for ($i = 0; $i < count($row); $i++) {
                        if ($i == 0) {
                            $count_firms_percsv++;
                            $lawfirm = LawFirm::where('name', $row[0])->first();
                            if (!$lawfirm) {
                                //           echo "Firm not found: ".$row[0]."\n";
                                $count_firms_notfound++;
                            } else {
                                $count_firms_found++;
                            }
                        } else {
                            if ($lawfirm and $row[$i] == "*") {
                                $count_matches_firms_firm_bands++;
                                $lawfirm->bands()->attach($band[$i - 1]);
                            }
                        }
                    }
                }
            }

            /*
            echo "Total firms: ".$count_firms_percsv."\n";
            echo "Total firms not found: ".$count_firms_notfound."\n";
            echo "Total firms found: ".$count_firms_found."\n";
            echo "Total matches firm - firm bands: ".$count_matches_firms_firm_bands."\n";
            echo "-------------------------------------\n";
             */
        }

        //Add all law firms to all law firms band
        $allLawFirms = LawFirm::all();

        $allLawFirmBand = LawFirmBand::find(1);

        $allLawFirmsIdList = $allLawFirms->pluck('id')->toArray();

        $allLawFirmBand->lawFirm()->attach($allLawFirmsIdList);
    }

    protected function truncateTables()
    {
        LawFirm::truncate();
        LawFirmDomain::truncate();
        DB::table('law_firm_law_firm_band')->truncate();
    }
}
