<?php

use Illuminate\Database\Seeder;
use App\Models\LawFirmBand;
use App\Models\LawFirm;

class OptionLawFirmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allLawFirmsBand = LawFirmBand::findOrFail(1);

        $outsideLegalBand = LawFirmBand::create(
            [
                'name'      => 'Outside of Legal',
                'rank'      => 5,
                'order'     => 0,
                'parent_id' => null,
                'is_option' => 1,
            ]
        );

        $outsideLegalFirm = LawFirm::create(
            [
                'name'      => 'Outside of Legal',
                'is_option' => 1,
            ]
        );

        $outsideLegalFirm->bands()->attach($outsideLegalBand);
        $outsideLegalFirm->bands()->attach($allLawFirmsBand);
        $outsideLegalFirm->save();

        $inHouseLegalBand = LawFirmBand::create(
            [
                'name'      => 'In House Legal Department',
                'rank'      => 5,
                'order'     => 0,
                'parent_id' => null,
                'is_option' => 1,
            ]
        );

        $inHouseLegalFirm = LawFirm::create(
            [
                'name'      => 'In House Legal Department',
                'is_option' => 1,
            ]
        );

        $inHouseLegalFirm->bands()->attach($inHouseLegalBand);
        $inHouseLegalFirm->bands()->attach($allLawFirmsBand);
        $inHouseLegalFirm->save();
    }
}
