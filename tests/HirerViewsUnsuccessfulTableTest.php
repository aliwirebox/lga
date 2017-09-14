<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HirerViewsUnsuccessfulTableTest extends TestCase
{
    use DatabaseTransactions;

    protected $hirer;

    public function setUp()
    {
        parent::setUp();

        $this->hirer = factory(Hirer::class)->create([
            'law_firm_id' => 1,
        ]);
    }

    /**
     * @test
     */
    public function candidatesAreBlocked()
    {
        $candidate = factory(Candidate::class)->create();

        $this->actingAs($candidate, 'candidates')
            ->call('GET', route('hirer.unsuccessful-candidates'));

        $this->assertResponseStatus(403);
    }

    /**
     * @test
     */
    public function adminsAreBlocked()
    {
        $admin = factory(BrandAdmin::class)->create();

        $this->actingAs($admin, 'brand_admins')
            ->call('GET', route('hirer.unsuccessful-candidates'));

        $this->assertResponseStatus(403);
    }

    /**
     * @test
     */
    public function hirerCanSeePage()
    {
        $this->actingAs($this->hirer, 'hirers')
            ->visit(route('hirer.unsuccessful-candidates'))
            ->see('Unsuccessful Candidates');
    }

    /**
     * @test
     */
    public function hirerCanGetDatatableData()
    {
        $search = factory(Search::class)->create([
            'hirer_id' => $this->hirer->id
        ]);

        $candidates = factory(Candidate::class, 4)->create();

        $search->matches()->sync([
            $candidates[0]->id => ['status' => config('match.unsuccessful')],
            $candidates[1]->id => ['status' => config('match.cv-rejected')],
            $candidates[2]->id => ['status' => config('match.cv-pending')],
        ]);

        $candidates[0]->delete();

        $otherHirer = factory(Hirer::class)->create([
            'law_firm_id' => 2,
        ]);

        $otherSearch = factory(Search::class)->create([
            'hirer_id' => $otherHirer->id
        ]);

        $otherSearch->matches()->sync([
            $candidates[3]->id => ['status' => config('match.unsuccessful')],
        ]);

        $this->actingAs($this->hirer, 'hirers')
            ->json('GET', route('hirer.unsuccessful-candidates.data'))
            ->seeJson([
                'id' => $candidates[0]->id,
            ])
            ->seeJson([
                'id' => $candidates[1]->id,
            ])
            ->dontSeeJson([
                'id' => $candidates[2]->id,
            ])
            ->dontSeeJson([
                'id' => $candidates[3]->id,
            ]);
    }
}
