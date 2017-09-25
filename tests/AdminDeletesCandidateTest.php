<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminDeletesCandidateTest extends TestCase
{
    use DatabaseTransactions;

    protected $brandAdmin;

    public function setUp()
    {
        parent::setUp();

        $this->brandAdmin = factory(BrandAdmin::class)->create();
    }

    /**
     * @test
     */
    public function adminCanDeleteCandidate()
    {
        $candidate = factory(Candidate::class)->create();
        $candidateId = $candidate->id;

        $searches = factory(Search::class, 8)->create();
        $searches[0]->matches()->sync([$candidateId]);
        $searches[1]->matches()->sync([$candidateId => ['status' => config('match.cv-request')]]);
        $searches[2]->matches()->sync([$candidateId => ['status' => config('match.cv-rejected')]]);
        $searches[3]->matches()->sync([$candidateId => ['status' => config('match.cv-pending')]]);
        $searches[4]->matches()->sync([$candidateId => ['status' => config('match.cv-sent')]]);
        $searches[5]->matches()->sync([$candidateId => ['status' => config('match.first-interview')]]);
        $searches[6]->matches()->sync([$candidateId => ['status' => config('match.second-interview')]]);
        $searches[7]->matches()->sync([$candidateId => ['status' => config('match.offer')]]);

        $response = $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('DELETE', route('brand-admin.candidates.destroy', ['id' => $candidate->id]));

        $candidate = $candidate->fresh();

        $response->assertResponseStatus(200);
        $this->assertNull($candidate);

        $this->assertMatchDeleted($candidateId, $searches[0]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[1]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[2]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[3]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[4]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[5]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[6]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[7]->id);
    }

    /**
     * @test
     */
    public function deleteCandidateReturns404ForUnknownCandidate()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('DELETE', route('brand-admin.candidates.destroy', ['id' => 100000]))
            ->assertResponseStatus(404);
    }

    /**
     * @test
     */
    public function candidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->json('DELETE', route('brand-admin.candidates.destroy', ['id' => $candidate->id]))
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function hirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->json('DELETE', route('brand-admin.candidates.destroy', ['id' => $candidate->id]))
            ->assertResponseStatus(401);
    }
}
