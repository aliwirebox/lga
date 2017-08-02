<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\LawFirm;
use App\Models\Search;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HirerViewsMatchTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;
    protected $hirer;
    protected $search;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = factory(Candidate::class)->create();
        $this->hirer = factory(Hirer::class)->create();
        $this->search = factory(Search::class)->create(['hirer_id' => $this->hirer->id]);
        $this->search->matches()->sync([
            $this->candidate->id => [
                'status' => 0,
            ]
        ]);
    }

    public function invalidParams()
    {
        return [
            'whenEmpty' => [
                [],
            ],
        ];
    }

    /**
     * @dataProvider invalidParams
     */
    public function testParamValidation($params)
    {
        $this->actingAs($this->hirer, 'hirers')
            ->json('PATCH', route('hirer.search.results.viewed', $this->search->id), $params)
            ->assertResponseStatus(422);
    }

    public function testSearchHasToBeFound()
    {
        $this->actingAs($this->hirer, 'hirers')
            ->json('PATCH', route('hirer.search.results.viewed', 'not-a-id'), [
                'candidate_id_list' => [$this->candidate->id],
            ])
            ->assertResponseStatus(404);
    }

    public function testHirerCantEditSearchesThatDontBelongToTheirLawFirm()
    {
        $firm = LawFirm::where('id', '<>', $this->hirer->lawFirm->id)->first();
        $hirer = factory(Hirer::class)->create(['law_firm_id' => $firm->id]);
        $search = factory(Search::class)->create(['hirer_id' => $hirer->id]);
        $search->matches()->sync([
            $this->candidate->id => [
                'status' => 0,
            ]
        ]);

        $this->actingAs($this->hirer, 'hirers')
            ->json('PATCH', route('hirer.search.results.viewed', $search->id), [
                'candidate_id_list' => [$this->candidate->id],
            ])
            ->assertResponseStatus(403);
    }

    public function testCandidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->json('PATCH', route('hirer.search.results.viewed', $this->search->id), [
                'candidate_id_list' => [$this->candidate->id],
            ])
            ->assertResponseStatus(401);
    }

    public function testRequestingACv()
    {
        $this->actingAs($this->hirer, 'hirers')
            ->json('PATCH', route('hirer.search.results.viewed', $this->search->id), [
                'candidate_id_list' => [$this->candidate->id],
            ])
            ->assertResponseStatus(200)
            ->seeInDatabase('candidate_search', [
                'candidate_id' => $this->candidate->id,
                'search_id'    => $this->search->id,
                'hirer_viewed' => true,
            ]);
    }
}
