<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CandidateRequestsPendingEmailTest extends TestCase
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
        $params = $params + ['id' => $this->search->id];
        
        $this->actingAs($this->candidate, 'candidates')
            ->call('GET', route('candidate.cv-requests-pending.email', $params));

        $this->assertResponseStatus(422);
    }

    public function testSearchHasToBeFound()
    {
        $params = [
            'id'     => 'not-a-id',
            'status' => 300,
        ];

        $this->actingAs($this->candidate, 'candidates')
            ->call('GET', route('candidate.cv-requests-pending.email', $params));
        
        $this->assertResponseStatus(404);
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

        $params = [
            'id'     => $search->id,
            'status' => config('match.cv-rejected')
        ];

        $this->actingAs($this->candidate, 'candidates')
            ->call('GET', route('candidate.cv-requests-pending.email', $params));
        
        $this->assertResponseStatus(401);
    }

#    public function testHirersAreBlocked()
#    {
#        $hirer = factory(Hirer::class)->create();
#
#        $params = [
#            'id'     => $this->search->id,
#            'status' => config('match.cv-rejected')
#        ];
#
#        $this->actingAs($hirer, 'hirers')
#             ->call('GET', route('candidate.cv-requests-pending.email', $params));
#
#        $this->assertResponseStatus(401);
#    }

    public function testCandidatesAreBlockedFromEditingSearchesThatDontHaveAStatusOfCvRequest()
    {
        $search = factory(Search::class)->create();
        $search->matches()->sync([
            $this->candidate->id => [
                'status' => 0
            ]
        ]);

        $params = [
            'id'     => $search->id,
            'status' => config('match.cv-rejected')
        ];

        $this->actingAs($this->candidate, 'candidates')
            ->call('GET', route('candidate.cv-requests-pending.email', $params));

        $this->assertResponseStatus(401);
    }

    public function testRejectingACvRequest()
    {
        $params = [
            'id'     => $this->search->id,
            'status' => config('match.cv-rejected')
        ];

        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.cv-requests-pending.email', $params))
            ->seePageIs(route('candidate.live-vacancies'))
            ->seeInDatabase('candidate_search', [
                'candidate_id' => $this->candidate->id,
                'search_id' => $this->search->id,
                'status' => config('match.cv-rejected'),
            ]);
    }

    public function testAcceptingACvRequest()
    {
        $params = [
            'id'     => $this->search->id,
            'status' => config('match.cv-pending'),
        ];

        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.cv-requests-pending.email', $params))
            ->seePageIs(route('candidate.live-vacancies'))
            ->seeInDatabase('candidate_search', [
                'candidate_id' => $this->candidate->id,
                'search_id' => $this->search->id,
                'status' => config('match.cv-pending'),
            ]);
    }
}
