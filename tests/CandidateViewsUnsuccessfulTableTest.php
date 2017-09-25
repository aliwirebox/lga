<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CandidateViewsUnsuccessfulTableTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = factory(Candidate::class)->create();
    }

    /**
     * @test
     */
    public function hirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->call('GET', route('candidate.unsuccessful-vacancies'));

        $this->assertResponseStatus(403);
    }

    /**
     * @test
     */
    public function adminsAreBlocked()
    {
        $admin = factory(BrandAdmin::class)->create();

        $this->actingAs($admin, 'brand_admins')
            ->call('GET', route('candidate.unsuccessful-vacancies'));

        $this->assertResponseStatus(403);
    }

    /**
     * @test
     */
    public function candidateCanSeePage()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.unsuccessful-vacancies'))
            ->see('Unsuccessful Vacancies');
    }

    /**
     * @test
     */
    public function candidateCanGetDatatableData()
    {
        $deletedSearch = factory(Search::class)->create();

        $deletedSearch->matches()->sync([
            $this->candidate->id => ['status' => config('match.unsuccessful')],
        ]);

        $deletedSearch->hirer->lawFirm->delete(); //should still be viewable if all records are deleted

        $otherCandidate = factory(Candidate::class)->create();

        $searches = factory(Search::class, 4)->create();

        $searches[0]->matches()->sync([
            $this->candidate->id => ['status' => config('match.unsuccessful')],
        ]);

        $searches[1]->matches()->sync([
            $this->candidate->id => ['status' => config('match.cv-rejected')],
        ]);

        $searches[2]->matches()->sync([
            $this->candidate->id => ['status' => config('match.cv-pending')],
        ]);

        $searches[3]->matches()->sync([
            $otherCandidate->id => ['status' => config('match.unsuccessful')],
        ]);

        $this->actingAs($this->candidate, 'candidates')
            ->json('GET', route('candidate.unsuccessful-vacancies.data'))
            ->seeJson([
                'match_search_id' => $deletedSearch->id,
            ])
            ->seeJson([
                'match_search_id' => $searches[0]->id,
            ])
            ->seeJson([
                'match_search_id' => $searches[1]->id,
            ])
            ->dontSeeJson([
                'match_search_id' => $searches[2]->id,
            ])
            ->dontSeeJson([
                'match_search_id' => $searches[3]->id,
            ]);
    }
}
