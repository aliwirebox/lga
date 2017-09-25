<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminViewsCandidateTableTest extends TestCase
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
    public function adminCanSeePage()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.candidates'))
            ->see('Candidate Database');
    }

    /**
     * @test
     */
    public function adminCanGetDatatableData()
    {
        $candidates = factory(Candidate::class, 2)->create();

        $candidates[0]->delete();

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('GET', route('brand-admin.candidates.data'))
            ->seeJson([
                'id' => $candidates[0]->id,
            ])
            ->seeJson([
                'id' => $candidates[1]->id,
            ]);
    }
}
