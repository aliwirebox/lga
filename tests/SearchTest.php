<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use App\Models\Location;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SearchTest extends TestCase
{
    use DatabaseTransactions;

    protected $expectedCandidate;
    protected $departmentId = 1;
    protected $location;
    protected $search;

    /**
     * Sets up a candidate and a search with the minimum
     * required information to match.
     *
     * Some tests will toggle the required fields to check they
     * result in the expected candidate not being returned.
     *
     * Some tests will toggle additional information to see that
     * the expected candidate is still returned
     */
    public function setUp()
    {
        parent::setUp();

        $this->location = Location::whereName('England')->firstOrFail();

        $hirer = factory(Hirer::class)->create([
            'law_firm_id' => 1
        ]);

        $this->search = Search::create([
            'hirer_id'              => $hirer->id,
            'vacancy_location_id'   => $this->location->id,
            'vacancy_salary'        => 1000000,
            'vacancy_department_id' => $this->departmentId,
            'position_permanent'    => true,
        ]);

        $this->expectedCandidate = factory(Candidate::class)->create([
            'role_id'              => 1,
            'is_live'              => true,
            'current_law_firm_id'  => 2,
            'training_law_firm_id' => 2,
            'seeking_permanent'    => true,
        ]);
        
        $this->expectedCandidate->preferedDepartments()->sync([$this->departmentId]);
        $this->expectedCandidate->preferedLocations()->sync([$this->location->id]);
    }

    /**
     * @test
     */
    public function setupSearchReturnsExpectedCandidate()
    {
        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function newlyFoundCandidatesAreAddedAsUnviewedToMatches()
    {
        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertEquals(1, $this->search->unviewed_matches_count);
        $this->assertEquals(1, $this->search->matches->count());
    }

    /**
     * @test
     */
    public function previouslyFoundCandidatesKeepTheyViewedStatusAfterMatchesUpdate()
    {
        $candidate2 = $this->cloneExpectedCandidate();

        $this->search->matches()->sync([
            $this->expectedCandidate->id => ['hirer_viewed' => true],
            $candidate2->id              => ['hirer_viewed' => false],
        ]);

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertEquals(1, $this->search->unviewed_matches_count);
        $this->assertEquals(2, $this->search->matches->count());
    }

    /**
     * @test
     */
    public function candidatesThatNoLongerFoundAreRemovedFromMatches()
    {
        $this->search->matches()->sync([
            $this->expectedCandidate->id => ['hirer_viewed' => false],
        ]);

        $this->expectedCandidate->is_live = false;
        $this->expectedCandidate->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchDoesntReturnAnyCandidates();
    }

    /**
     * @test
     */
    public function candidatesThatNoLongerFoundButHaveHadCVRequestAreNotRemovedFromMatches()
    {
        $this->search->matches()->sync([
            $this->expectedCandidate->id => ['hirer_viewed' => true, 'status' => config('match.cv-request')],
        ]);

        $this->expectedCandidate->is_live = false;
        $this->expectedCandidate->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesThatArentLive()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->is_live = false;
        $unexpectedCandidate->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function testSearchReturnsCandidatesThatArentCurrentlyWorking()
    {
        $this->expectedCandidate->current_law_firm_id = null;
        $this->expectedCandidate->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesThatWorkForTheHirersLawFirm()
    {
        $this->expectedCandidate->current_law_firm_id = $this->search->hirer->law_firm_id;
        $this->expectedCandidate->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchDoesntReturnAnyCandidates();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesWhoHaveBlacklistedTheCompany()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->blacklistedLawFirms()->sync([$this->search->hirer->law_firm_id, 2]);
        $this->expectedCandidate->blacklistedLawFirms()->sync([2, 3]);

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesWithoutDegreeWhenRequired()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->has_degree = false;
        $unexpectedCandidate->save();

        $this->expectedCandidate->has_degree = true;
        $this->expectedCandidate->save();

        $this->search->has_degree = true;
        $this->search->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesWhoArentAvailableWhenRequired()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->available_date = '2017-01-03';
        $unexpectedCandidate->save();

        $this->expectedCandidate->available_date = '2017-01-01';
        $this->expectedCandidate->save();

        $this->search->available_date = '2017-01-02';
        $this->search->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesWhoRequireHighSalaries()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->minimum_salary = 35;
        $unexpectedCandidate->save();

        $this->expectedCandidate->minimum_salary = 25;
        $this->expectedCandidate->save();

        $this->search->vacancy_salary = 30;
        $this->search->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchReturnCandidatesWithAnyOfTheRequiredLanguages()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->languages()->sync([5, 6]);

        $this->expectedCandidate->languages()->sync([1, 2, 3]);

        $this->search->languages()->sync([3, 4]);

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchDoesntReturnCandidatesWithAnyOfTheRequiredTrainingSeats()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->trainingSeats()->sync([1]);

        $this->expectedCandidate->trainingSeats()->sync([1, 2, 3]);

        $this->search->trainingSeats()->sync([2, 3, 4]);

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchReturnCandidatesWhoHaveSelectedTheVacancyDepartmentAsOneOfTheirPrefered()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();

        $unexpectedCandidate->preferedDepartments()->sync([$this->departmentId + 1]);

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchReturnCandidatesWhoHaveSelectedRolesWhichMatchTheSearchFilter()
    {
        $unexpectedCandidate = $this->cloneExpectedCandidate();
        $unexpectedCandidate->role_id = 2;
        $unexpectedCandidate->save();

        $this->search->role_id = 1;
        $this->search->save();

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    /**
     * @test
     */
    public function searchReturnsCandidatesWhoHaveSelectedALocationWhichCoversTheVacancyLocation()
    {
        $parentLocation = $this->location->parent;
        $childLocation = $this->location->children->first();

        $unexpectedCandidate = $this->cloneExpectedCandidate();
        $unexpectedCandidate->preferedLocations()->sync([$childLocation->id]);

        $this->expectedCandidate->preferedLocations()->sync([$parentLocation->id]);

        $this->search->updateMatches();
        $this->search = $this->search->fresh();

        $this->assertSearchOnlyReturnsExpectedCandidate();
    }

    public function cloneExpectedCandidate()
    {
        $candidate = $this->expectedCandidate->replicate();
        $candidate->save();

        $candidate->preferedDepartments()->sync([$this->departmentId]);
        $candidate->preferedLocations()->sync([$this->location->id]);

        return $candidate;
    }

    public function assertSearchDoesntReturnAnyCandidates()
    {
        $this->assertEquals(0, $this->search->unviewed_matches_count);
        $this->assertEquals(0, $this->search->matches->count());
    }

    public function assertSearchOnlyReturnsExpectedCandidate()
    {
        $this->assertEquals(1, $this->search->matches->count());
        $this->assertEquals($this->expectedCandidate->id, $this->search->matches->first()->id);
    }
}
