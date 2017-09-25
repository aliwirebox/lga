<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminViewsUnsuccessfulTableTest extends TestCase
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
    public function candidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->call('GET', route('brand-admin.unsuccessful-candidates'));

        $this->assertResponseStatus(403);
    }

    /**
     * @test
     */
    public function hirersAreBlocked()
    {
        $hirer = factory(Hirer::class)->create();

        $this->actingAs($hirer, 'hirers')
            ->call('GET', route('brand-admin.unsuccessful-candidates'));

        $this->assertResponseStatus(403);
    }

    /**
     * @test
     */
    public function adminCanSeePage()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.unsuccessful-candidates'))
            ->see('Unsuccessful Candidates');
    }

    /**
     * @test
     */
    public function adminCanGetDatatableData()
    {
        $search = factory(Search::class)->create();
        $candidates = factory(Candidate::class, 3)->create();

        $search->matches()->sync([
            $candidates[0]->id => ['status' => config('match.unsuccessful')],
            $candidates[1]->id => ['status' => config('match.cv-rejected')],
            $candidates[2]->id => ['status' => config('match.cv-pending')],
        ]);

        $candidates[0]->delete();

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('GET', route('brand-admin.unsuccessful-candidates.data'))
            ->seeJson([
                'id' => $candidates[0]->id,
            ])
            ->seeJson([
                'id' => $candidates[1]->id,
            ])
            ->dontSeeJson([
                'id' => $candidates[2]->id,
            ]);
    }
}
