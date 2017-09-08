<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\BrandAdmin;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminLoginAsCandidateTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;
    protected $brandAdmin;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = factory(Candidate::class)->create([
            'telephone'  => '01923 111111',
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::yesterday(),
        ]);
        $this->brandAdmin = factory(BrandAdmin::class)->create();
    }


    public function testCandidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->call('GET', route('brand-admin.candidates.login', $this->candidate->id));


        $this->assertResponseStatus(403);
    }

    public function testHirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->call('GET', route('brand-admin.candidates.login', $this->candidate->id));


        $this->assertResponseStatus(403);
    }

    public function testAdminCanLoginAsCandidate()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.candidates.login', $this->candidate->id))
            ->seePageIs(route('candidate.dashboard'))
            ->assertSessionHas('acting.brand_admin.email', $this->brandAdmin->email);
    }

    public function testAdminCanEditCandidateWithoutTouchingTimestamps()
    {
        $originalUpdatedAt = $this->candidate->updated_at;

        $this->actingAs($this->candidate, 'candidates')
            ->withSession(['acting.brand_admin.email' => $this->brandAdmin->email])
            ->visit(route('candidate.profile.details'))
            ->type('01923 000000', 'telephone')
            ->press('Update')
            ->seePageIs(route('candidate.profile'))
            ->seeInDatabase('candidates', [
                'id'         => $this->candidate->id,
                'updated_at' => $originalUpdatedAt,
            ]);
    }

    public function testWhenCandidateMakesEditTimestampsAreTouched()
    {
        $originalUpdatedAt = $this->candidate->updated_at;

        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.profile.details'))
            ->type('01923 000000', 'telephone')
            ->press('Update')
            ->seePageIs(route('candidate.profile'))
            ->dontSeeInDatabase('candidates', [
                'id'         => $this->candidate->id,
                'updated_at' => $originalUpdatedAt,
            ]);
    }

    public function testSessionIsClearedOnLogout()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->withSession(['acting.brand_admin.email' => $this->brandAdmin->email])
            ->visit('/logout')
            ->seePageIs('/')
            ->assertSessionMissing('acting.brand_admin.email');
    }
}
