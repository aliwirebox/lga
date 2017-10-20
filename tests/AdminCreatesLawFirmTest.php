<?php

use App\Models\BrandAdmin;
use App\Models\LawFirm;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminCreatesLawFirmTest extends TestCase
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
    public function adminCreatesNewLawFirm()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.law-firms.create'))
            ->type('New Firm', 'name')
            ->type('@new-firm.com, @new-firm2.com', 'domains')
            ->press('Create')
            ->seePageIs(route('brand-admin.law-firms'))
            ->see('Company created');

        $lawFirm = LawFirm::whereName('New Firm')->first();

        $this->assertNotNull($lawFirm);
        $this->assertEquals(3, $lawFirm->domains->count());
        $this->assertEquals(config('brand.email.domain'), $lawFirm->domains[0]->name);
        $this->assertEquals('@new-firm.com', $lawFirm->domains[1]->name);
        $this->assertEquals('@new-firm2.com', $lawFirm->domains[2]->name);
    }

    /**
     * @test
     */
    public function adminCreatesNewLawFirmWithOutDomains()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.law-firms.create'))
            ->type('New Firm', 'name')
            ->press('Create')
            ->seePageIs(route('brand-admin.law-firms'))
            ->see('Company created');

        $lawFirm = LawFirm::whereName('New Firm')->first();

        $this->assertNotNull($lawFirm);
        $this->assertEquals(1, $lawFirm->domains->count());
        $this->assertEquals(config('brand.email.domain'), $lawFirm->domains[0]->name);
    }

    /**
     * @test
     */
    public function adminSubmitsBlankForm()
    {
        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.law-firms.create'))
            ->press('Create')
            ->seePageIs(route('brand-admin.law-firms.create'))
            ->see('The name field is required.');
    }

    /**
     * @test
     */
    public function adminSubmitsDuplicateLawFirm()
    {
        LawFirm::create([
            'name' => 'Duplicate'
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.law-firms.create'))
            ->type('Duplicate', 'name')
            ->press('Create')
            ->seePageIs(route('brand-admin.law-firms.create'))
            ->see('The name has already been taken');
    }
}
