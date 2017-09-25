<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\FailedHirerRegistration;
use App\Models\Hirer;
use App\Models\LawFirm;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AdminApprovesFailedHirerRegitrationTest extends TestCase
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
    public function adminCanApproveHirerAndLawFirmAddition()
    {
        $failedRegistration = factory(FailedHirerRegistration::class)->create([
            'first_name'   => 'John',
            'last_name'    => 'Smith',
            'email'        => 'john@law.com',
            'telephone'    => '07712312312',
            'password'     => 'testtest',
            'add_law_firm' => 'Law Inc',
            'law_firm_id'  => null,
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.failed-hirer-registration.approve', $failedRegistration))
            ->see('Hirer registration approved');

        $hirer = Hirer::whereEmail('john@law.com')->first();

        $this->assertNotNull($hirer);
        $this->assertEquals('John', $hirer->first_name);
        $this->assertEquals('Smith', $hirer->last_name);
        $this->assertEquals('john@law.com', $hirer->email);
        $this->assertEquals('07712312312', $hirer->telephone);
        $this->assertEquals('testtest', $hirer->password);
        $this->assertEquals(0, $hirer->email_verified);
        $this->assertNotNull($hirer->lawFirm);
        $this->assertEquals('Law Inc', $hirer->lawFirm->name);
        $this->assertNotNull($hirer->lawFirm->domains);
        $this->assertEquals(2, $hirer->lawFirm->domains->count());
        $this->assertEquals('@law.com', $hirer->lawFirm->domains[1]->name);
    }

    /**
     * @test
     */
    public function adminCanApproveHirerAndDomainAddition()
    {
        $lawFirm = LawFirm::create(['name' => 'Test Firm']);

        $failedRegistration = factory(FailedHirerRegistration::class)->create([
            'first_name'   => 'John',
            'last_name'    => 'Smith',
            'email'        => 'john@law.com',
            'telephone'    => '07712312312',
            'password'     => 'testtest',
            'add_law_firm' => '',
            'law_firm_id'  => $lawFirm->id,
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.failed-hirer-registration.approve', $failedRegistration))
            ->see('Hirer registration approved');

        $hirer = Hirer::whereEmail('john@law.com')->first();

        $this->assertNotNull($hirer);
        $this->assertEquals('John', $hirer->first_name);
        $this->assertEquals('Smith', $hirer->last_name);
        $this->assertEquals('john@law.com', $hirer->email);
        $this->assertEquals('07712312312', $hirer->telephone);
        $this->assertEquals('testtest', $hirer->password);
        $this->assertEquals(0, $hirer->email_verified);
        $this->assertNotNull($hirer->lawFirm);
        $this->assertEquals('Test Firm', $hirer->lawFirm->name);
        $this->assertNotNull($hirer->lawFirm->domains);
        $this->assertEquals(2, $hirer->lawFirm->domains->count());
        $this->assertEquals('@law.com', $hirer->lawFirm->domains[1]->name);
    }

    /**
     * @test
     */
    public function adminApprovesRegistrationButCandidateHasUsedEmail()
    {
        $candidate = factory(Candidate::class)->create();

        $failedRegistration = factory(FailedHirerRegistration::class)->create([
            'email' => $candidate->email,
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.failed-hirer-registration.approve', $failedRegistration))
            ->see('The email has already been taken');

        $hirer = Hirer::whereEmail($candidate->email)->first();

        $this->assertNull($hirer);
    }

    /**
     * @test
     */
    public function adminApprovesRegistrationButiHirerHasUsedEmail()
    {
        $hirer = factory(Hirer::class)->create();

        $failedRegistration = factory(FailedHirerRegistration::class)->create([
            'email' => $hirer->email,
        ]);

        $this->actingAs($this->brandAdmin, 'brand_admins')
            ->visit(route('brand-admin.failed-hirer-registration.approve', $failedRegistration))
            ->see('The email has already been taken');
    }
}
