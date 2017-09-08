<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\BrandAdmin;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminLoginAsHirerTest extends TestCase
{
    use DatabaseTransactions;

    protected $hirer;
    protected $brandAdmin;

    public function setUp()
    {
        parent::setUp();

        $this->hirer = factory(Hirer::class)->create([
            'telephone'  => '01923 111111',
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::yesterday(),
        ]);
        $this->brandAdmin = factory(BrandAdmin::class)->create();
    }


    public function testCandidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'hirers')
            ->call('GET', route('brand-admin.hirers.login', $this->hirer->id));


        $this->assertResponseStatus(403);
    }

    public function testHirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->call('GET', route('brand-admin.hirers.login', $this->hirer->id));


        $this->assertResponseStatus(403);
    }

    public function testAdminCanLoginAsCandidate()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.hirers.login', $this->hirer->id))
            ->seePageIs(route('hirer.dashboard'))
            ->assertSessionHas('acting.brand_admin.email', $this->brandAdmin->email);
    }

    public function testAdminCanEditHirerWithoutTouchingTimestamps()
    {
        $originalUpdatedAt = $this->hirer->updated_at;

        $this->actingAs($this->hirer, 'hirers')
            ->withSession(['acting.brand_admin.email' => $this->brandAdmin->email])
            ->visit(route('hirer.details.edit'))
            ->type('01923 000000', 'telephone')
            ->press('Update')
            ->see('Your details has been successfully changed')
            ->seeInDatabase('hirers', [
                'id'         => $this->hirer->id,
                'updated_at' => $originalUpdatedAt,
            ]);
    }

    public function testWhenHirerMakesEditTimestampsAreTouched()
    {
        $originalUpdatedAt = $this->hirer->updated_at;

        $this->actingAs($this->hirer, 'hirers')
            ->visit(route('hirer.details.edit'))
            ->type('01923 000000', 'telephone')
            ->press('Update')
            ->see('Your details has been successfully changed')
            ->dontSeeInDatabase('hirers', [
                'id'         => $this->hirer->id,
                'updated_at' => $originalUpdatedAt,
            ]);
    }

    public function testSessionIsClearedOnLogout()
    {
        $this->actingAs($this->hirer, 'hirers')
            ->withSession(['acting.brand_admin.email' => $this->brandAdmin->email])
            ->visit('/logout')
            ->seePageIs('/')
            ->assertSessionMissing('acting.brand_admin.email');
    }
}
