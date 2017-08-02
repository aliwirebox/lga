<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SearchTest extends TestCase
{
    use DatabaseTransactions;

    public function testNewlyFoundCandidatesAreAddedAsUnviewedToMatches()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $newCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $newCandidate->preferedDepartments()->sync([1]);
        $newCandidate->preferedLawFirmBands()->sync([1]);
        $newCandidate->preferedLocations()->sync([1]);

        $search->updateMatches();
        $search = $search->fresh();
    
        $this->assertEquals(1, $search->unviewed_matches_count);
        $this->assertEquals(1, $search->matches->count());
    }

    public function testPreviouslyFoundCandidatesKeepTheyViewedStatusAfterMatchesUpdate()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $candidates = factory(Candidate::class, 2)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ])->each(function ($candidate) {
            $candidate->preferedDepartments()->sync([1]);
            $candidate->preferedLawFirmBands()->sync([1]);
            $candidate->preferedLocations()->sync([1]);
        });

        $search->matches()->sync([
            $candidates[0]->id => ['hirer_viewed' => true],
            $candidates[1]->id => ['hirer_viewed' => false],
        ]);

        $search->updateMatches();
        $search = $search->fresh();

        $this->assertEquals(1, $search->unviewed_matches_count);
        $this->assertEquals(2, $search->matches->count());
    }

    public function testCandidatesThatNoLongerFoundAreRemovedFromMatches()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $candidates = factory(Candidate::class, 2)->create([
            'is_live'              => false,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ])->each(function ($candidate) {
            $candidate->preferedDepartments()->sync([1]);
            $candidate->preferedLawFirmBands()->sync([1]);
            $candidate->preferedLocations()->sync([1]);
        });

        $search->matches()->sync([
            $candidates[0]->id => ['hirer_viewed' => true],
            $candidates[1]->id => ['hirer_viewed' => false],
        ]);

        $search->updateMatches();
        $search = $search->fresh();

        $this->assertEquals(0, $search->unviewed_matches_count);
        $this->assertEquals(0, $search->matches->count());
    }

    public function testCandidatesThatNoLongerFoundButHaveHadCVRequestAreNotRemovedFromMatches()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $candidates = factory(Candidate::class, 2)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ])->each(function ($candidate) {
            $candidate->preferedDepartments()->sync([2]);
            $candidate->preferedLawFirmBands()->sync([1]);
            $candidate->preferedLocations()->sync([1]);
        });

        $search->matches()->sync([
            $candidates[0]->id => ['hirer_viewed' => true, 'status' => 100],
        ]);

        $search->updateMatches();
        $search = $search->fresh();

        $this->assertEquals(1, $search->matches->count());
    }

    public function testSearchDoesntReturnCandidatesThatArentLive()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => false,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchReturnsCandidatesThatArentCurrentlyWorking()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => null,
            'training_law_firm_id' => 3,
        ]);

        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesThatWorkForTheHirersLawFirm()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 1,
            'training_law_firm_id' => 3,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 3,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesThatHaveTrainedWithTheHirersLawFirm()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 1,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 3,
            'training_law_firm_id' => 4,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWithLowerUcasPoints()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
            'min_ucas_points'       => 50,
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'ucas_points'          => 10,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'ucas_points'          => 50,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWithLowerDegree()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
            'min_degree_class'      => 50,
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'degree_class'         => 25,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'degree_class'         => 50,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWhoHaveQualifiedToEarly()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
            'date_qualified_from'   => '2016-03-01',
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'date_qualified'       => '2016-02-01',
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'date_qualified'       => '2016-03-01',
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWhoHaveQualifiedToLate()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
            'date_qualified_to'     => '2016-01-01',
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'date_qualified'       => '2016-02-01',
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'date_qualified'       => '2016-01-01',
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWhoRequireHighSalaries()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 20,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'minimum_salary'       => 30,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'minimum_salary'       => 20,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWithoutAnyAdditonalLaguages()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $search->languages()->sync([2, 3, 4]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $wrongCandidate->languages()->sync([1]);
        $expectedCandidate->languages()->sync([1, 2, 3]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWithAnyTrainingSeats()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $search->trainingSeats()->sync([2, 3, 4]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $wrongCandidate->trainingSeats()->sync([1]);
        $expectedCandidate->trainingSeats()->sync([1, 2, 3]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWhoHaventPreferedAnyOfHirersLawFirmBands()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 764]);
        $hirerLawFirmBands = $hirer->lawFirm->bands->pluck('id')->toArray(); //bands [1, 24, 78, 107]
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $wrongCandidate->preferedLawFirmBands()->sync([200]);
        $expectedCandidate->preferedLawFirmBands()->sync([120, $hirerLawFirmBands[0]]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchDoesntReturnCandidatesWhoHaventAttendUniInAnyOfTheSelectedUniBands()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $search->universityBands()->sync([5, 6]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'university_id'        => 100, //bands [1]
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'university_id'        => 50, //bands [1,6]
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchReturnCandidatesWhoHaveSelectedTheVacancyDepartmentAsOneOfTheirPrefered()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $wrongCandidate->preferedDepartments()->sync([2, 3]);
        $expectedCandidate->preferedDepartments()->sync([1, 2]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }

    public function testSearchReturnCandidatesWhoHaveSelectedTheVacancyLocationAsOneOfTheirPrefered()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
        ]);

        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);

        $wrongCandidate->preferedLocations()->sync([2, 3]);
        $expectedCandidate->preferedLocations()->sync([1, 2]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }


    public function testSearchDoesntReturnCandidatesWhoHaventGoneToATrainingFirmWithInTheSelectedTraingFirmLawBands()
    {
        $hirer = factory(Hirer::class)->create(['law_firm_id' => 1]);
        $search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => 1,
            'vacancy_location_id'   => 1, //london
        ]);

        $search->trainingLawFirmBands()->sync([104, 107]);

        $wrongCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'training_law_firm_id' => 788, //bands [4, 6, 41, 44]
        ]);

        $expectedCandidate = factory(Candidate::class)->create([
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'training_law_firm_id' => 764, //bands [24, 78, 107]
        ]);

        $wrongCandidate->preferedDepartments()->sync([1]);
        $wrongCandidate->preferedLawFirmBands()->sync([1]);
        $wrongCandidate->preferedLocations()->sync([1]);
        $expectedCandidate->preferedDepartments()->sync([1]);
        $expectedCandidate->preferedLawFirmBands()->sync([1]);
        $expectedCandidate->preferedLocations()->sync([1]);

        $this->assertEquals(1, $search->findCandidates()->count());
        $this->assertEquals($expectedCandidate->id, $search->findCandidates()->first()->id);
    }
}
