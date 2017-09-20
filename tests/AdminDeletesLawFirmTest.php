<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\LawFirm;
use App\Models\Search;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminDeletesLawFirmTest extends TestCase
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
    public function adminCanDeleteLawFirm()
    {
        $lawFirm = LawFirm::create(['name' => 'test firm']);

        $hirers = factory(Hirer::class, 2)->create([
            'law_firm_id' => $lawFirm->id,
        ]);

        $candidate = factory(Candidate::class)->create();
        $candidateId = $candidate->id;

        $searches = factory(Search::class, 8)->create([
            'name'     => 'Active Search',
            'hirer_id' => $hirers[0]->id,
        ]);

        $searches[0]->matches()->sync([$candidateId]);
        $searches[1]->matches()->sync([$candidateId => ['status' => config('match.cv-request')]]);
        $searches[2]->matches()->sync([$candidateId => ['status' => config('match.cv-rejected')]]);
        $searches[3]->matches()->sync([$candidateId => ['status' => config('match.cv-pending')]]);
        $searches[4]->matches()->sync([$candidateId => ['status' => config('match.cv-sent')]]);
        $searches[5]->matches()->sync([$candidateId => ['status' => config('match.first-interview')]]);
        $searches[6]->matches()->sync([$candidateId => ['status' => config('match.second-interview')]]);
        $searches[7]->matches()->sync([$candidateId => ['status' => config('match.offer')]]);

        $response = $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('DELETE', route('brand-admin.law-firms.destroy', $lawFirm));

        $activeSearches = Search::active()->where('hirer_id', $hirers[0]->id)->get();
        $lawFirm = $lawFirm->fresh();
        $hirer1 = $hirers[0]->fresh();
        $hirer2 = $hirers[1]->fresh();

        $response->assertResponseStatus(200);
        $this->assertNull($lawFirm);
        $this->assertNull($hirer1);
        $this->assertNull($hirer2);
        $this->assertEquals(0, $activeSearches->count());

        $this->assertMatchDeleted($candidateId, $searches[0]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[1]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[2]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[3]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[4]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[5]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[6]->id)
            ->assertMatchUnsuccessful($candidateId, $searches[7]->id);
    }
}
