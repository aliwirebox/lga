<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CandidateRequestsPendingTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;
    protected $search;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = factory(Candidate::class)->create();
        $this->search = factory(Search::class)->create();
        $this->search->matches()->sync([
            $this->candidate->id => [
                'status' => config('match.cv-request')
            ]
        ]);
    }

    public function invalidParams()
    {
        return [
            'whenEmpty' => [
                [],
            ],
            'whenStatusIsZero' => [
                ['status' => 0],
            ],
            'whenStatusIsCvSent' => [
                ['status' => 400],
            ],
            'whenStatusIsFirstInterview' => [
                ['status' => 500],
            ],
            'whenStatusIsFirstInterview' => [
                ['status' => 600],
            ],
            'whenStatusIsOffer' => [
                ['status' => 700],
            ],
        ];
    }

    /**
     * @dataProvider invalidParams
     */
    public function testStatusIsRequired($params)
    {
        $this->actingAs($this->candidate, 'candidates')
            ->json('PATCH', route('candidate.cv-requests-pending.update', $this->search->id), $params)
            ->assertResponseStatus(422);
    }

    public function testSearchHasToBeFound()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->json('PATCH', route('candidate.cv-requests-pending.update', 'not-a-id'), [
                'status' => 300,
            ])
            ->assertResponseStatus(404);
    }

    public function testSearchHasToHaveAMatchForCandidate()
    {
        $candidate = factory(Candidate::class)->create();
        $search = factory(Search::class)->create();
        $search->matches()->sync([
            $candidate->id => [
                'status' => config('match.cv-request')
            ]
        ]);

        $this->actingAs($this->candidate, 'candidates')
            ->json('PATCH', route('candidate.cv-requests-pending.update', $search->id), [
                'status' => config('match.cv-rejected')
            ])
            ->assertResponseStatus(401);
    }

    public function testHirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->json('PATCH', route('candidate.cv-requests-pending.update', $this->search->id), [
                'status' => config('match.cv-rejected'),
            ])
            ->assertResponseStatus(401);
    }

    public function testCandidatesAreBlockedFromEditingSearchesThatDontHaveAStatusOfCvRequest()
    {
        $search = factory(Search::class)->create();
        $search->matches()->sync([
            $this->candidate->id => [
                'status' => 0
            ]
        ]);

        $this->actingAs($this->candidate, 'candidates')
            ->json('PATCH', route('candidate.cv-requests-pending.update', $search->id), [
                'status' => config('match.cv-rejected'),
            ])
            ->assertResponseStatus(401);
    }

    public function testRejectingACvRequest()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->json('PATCH', route('candidate.cv-requests-pending.update', $this->search->id), [
                'status' => config('match.cv-rejected'),
            ])
            ->assertResponseStatus(200)
            ->seeInDatabase('candidate_search', [
                'candidate_id' => $this->candidate->id,
                'search_id' => $this->search->id,
                'status' => config('match.cv-rejected'),
            ]);
    }

    public function testAcceptingACvRequest()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->json('PATCH', route('candidate.cv-requests-pending.update', $this->search->id), [
                'status' => config('match.cv-pending'),
            ])
            ->assertResponseStatus(200)
            ->seeInDatabase('candidate_search', [
                'candidate_id' => $this->candidate->id,
                'search_id' => $this->search->id,
                'status' => config('match.cv-pending'),
            ]);
    }
}
