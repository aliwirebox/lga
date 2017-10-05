<?php

use App\Models\BrandAdmin;
use App\Models\LawFirm;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminUpdatesLawFirmTest extends TestCase
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
    public function adminUpdatesLawFirm()
    {
        $orignalLawFirm = LawFirm::create(['name' => 'New Firm']);

        $orignalLawFirm->domains()->createMany([
            ['name' => '@new-firm.com'],
            ['name' => '@new-firm2.com'],
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.law-firms.edit', ['id' => $orignalLawFirm->id]))
            ->see('New Firm')
            ->see('@new-firm.com, @new-firm2.com')
            ->type('Updated Firm', 'name')
            ->type('@new-firm.com, @new-firm3.com, @new-firm4.com,', 'domains')
            ->press('Update')
            ->seePageIs(route('brand-admin.law-firms'))
            ->see('Company updated');

        $lawFirm = LawFirm::whereName('Updated Firm')->first();

        $this->assertNotNull($lawFirm);
        $this->assertEquals(3, $lawFirm->domains->count());
        $this->assertEquals('@new-firm.com', $lawFirm->domains[0]->name);
        $this->assertEquals('@new-firm3.com', $lawFirm->domains[1]->name);
        $this->assertEquals('@new-firm4.com', $lawFirm->domains[2]->name);
    }

    /**
     * @test
     */
    public function adminUpdatesLawFirmWithBlankDomains()
    {
        $orignalLawFirm = LawFirm::create(['name' => 'New Firm']);

        $orignalLawFirm->domains()->createMany([
            ['name' => '@new-firm.com'],
            ['name' => '@new-firm2.com'],
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.law-firms.edit', ['id' => $orignalLawFirm->id]))
            ->type('Updated Firm', 'name')
            ->type('', 'domains')
            ->press('Update')
            ->seePageIs(route('brand-admin.law-firms'))
            ->see('Company updated');

        $lawFirm = LawFirm::whereName('Updated Firm')->first();

        $this->assertNotNull($lawFirm);
        $this->assertEquals(0, $lawFirm->domains->count());
    }
}
