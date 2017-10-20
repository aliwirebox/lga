<?php

use App\Models\BrandAdmin;
use App\Models\LawFirm;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminViewsLawFirmTableTest extends TestCase
{
    use DatabaseTransactions;

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
            ->visit(route('brand-admin.law-firms'))
            ->see('Employer Management Database');
    }

    /**
     * @test
     */
    public function adminCanGetDatatableData()
    {
        $lawFirm = LawFirm::first();


        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->json('GET', route('brand-admin.law-firms.data'))
            ->seeJson([
                'id'   => $lawFirm->id,
                'name' => $lawFirm->name,
            ]);
    }
}
