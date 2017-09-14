<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CandidateRequestsDeletionTest extends TestCase
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
    public function candidateCanRequestDeletion()
    {
        $candidate = factory(Candidate::class)->create();

        $response = $this->actingAs($this->candidate, 'candidates')
            ->json('POST', route('candidate.delete.request'))
            ->assertResponseStatus(200);
    }

    /**
     * @test
     */
    public function adminsAreBlocked()
    {
        $brandAdmin = factory(BrandAdmin::class)->create();

        $this->actingAs($brandAdmin, 'brand_admins')
            ->json('POST', route('candidate.delete.request'))
            ->assertResponseStatus(401);
    }

    /**
     * @test
     */
    public function hirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->json('POST', route('candidate.delete.request'))
            ->assertResponseStatus(401);
    }
}
