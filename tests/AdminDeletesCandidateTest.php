<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
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

        $response = $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('DELETE', route('brand-admin.candidates.destroy', ['id' => $candidate->id]));

        $candidate = $candidate->fresh();

        $response->assertResponseStatus(200);
        $this->assertNull($candidate);
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
