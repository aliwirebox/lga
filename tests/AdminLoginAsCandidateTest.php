<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\NqAdmin;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminLoginAsCandidateTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;
    protected $nqAdmin;

    public function setUp()
    {
        parent::setUp();

        $this->candidate = factory(Candidate::class)->create([
            'telephone'  => '01923 111111',
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::yesterday(),
        ]);
        $this->nqAdmin = factory(NqAdmin::class)->create();
    }


    public function testCandidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->call('GET', route('nq-admin.candidates.login', $this->candidate->id));


        $this->assertResponseStatus(403);
    }

    public function testHirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->call('GET', route('nq-admin.candidates.login', $this->candidate->id));


        $this->assertResponseStatus(403);
    }

    public function testAdminCanLoginAsCandidate()
    {
        $this->actingAs($this->nqAdmin, 'nq_admins')
            ->visit(route('nq-admin.candidates.login', $this->candidate->id))
            ->seePageIs(route('candidate.dashboard'))
            ->assertSessionHas('acting.nq_admin.email', $this->nqAdmin->email);
    }

    public function testAdminCanEditCandidateWithoutTouchingTimestamps()
    {
        $originalUpdatedAt = $this->candidate->updated_at;

        $this->actingAs($this->candidate, 'candidates')
            ->withSession(['acting.nq_admin.email' => $this->nqAdmin->email])
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
            ->withSession(['acting.nq_admin.email' => $this->nqAdmin->email])
            ->visit('/logout')
            ->seePageIs('/')
            ->assertSessionMissing('acting.nq_admin.email');
    }
}
