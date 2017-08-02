<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\LawFirm;
use App\Models\NqAdmin;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NqAdminChangeMatchStatusTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;
    protected $nqAdmin;
    protected $search;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = factory(Candidate::class)->create();
        $this->nqAdmin = factory(NqAdmin::class)->create();
        $this->search = factory(Search::class)->create();
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
            'whenMissingCandidateId' => [
                [
                    'status' => 100
                ],
            ],
            'whenInvalidStatus' => [
                [
                    'status' => 'not a status',
                    'candidate_id' => 1,
                ],
            ],
        ];
    }

    /**
     * @dataProvider invalidParams
     */
    public function testParamValidation($params)
    {
        $this->actingAs($this->nqAdmin, 'nq_admins')
            ->json('PATCH', route('nq-admin.search.update', $this->search->id), $params)
            ->assertResponseStatus(422);
    }

    public function testSearchHasToBeFound()
    {
        $this->actingAs($this->nqAdmin, 'nq_admins')
            ->json('PATCH', route('nq-admin.search.update', 'not-a-id'), [
                'status' => 700,
                'candidate_id' => $this->candidate->id,
            ])
            ->assertResponseStatus(404);
    }

    public function testCandidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->json('PATCH', route('nq-admin.search.update', $this->search->id), [
                 'status' => 700,
                 'candidate_id' => $this->candidate->id,
             ])
            ->assertResponseStatus(401);
    }

    public function testHirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->json('PATCH', route('nq-admin.search.update', $this->search->id), [
                 'status' => 700,
                 'candidate_id' => $this->candidate->id,
             ])
            ->assertResponseStatus(401);
    }

    public function testCantEditCandidatesThatArentMatchedWithSearch()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($this->nqAdmin, 'nq_admins')
            ->json('PATCH', route('nq-admin.search.update', $this->search->id), [
                'status' => 700,
                'candidate_id' => $candidate->id,
            ])
            ->assertResponseStatus(401);
    }

    public function testUpdatingStatus()
    {
        $this->actingAs($this->nqAdmin, 'nq_admins')
            ->json('PATCH', route('nq-admin.search.update', $this->search->id), [
                'status' => 700,
                'candidate_id' => $this->candidate->id,
            ])
            ->assertResponseStatus(200)
            ->seeInDatabase('candidate_search', [
                'candidate_id' => $this->candidate->id,
                'search_id' => $this->search->id,
                'status' => 700,
            ]);
    }
}
