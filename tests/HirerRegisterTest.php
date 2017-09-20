<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\FailedHirerRegistration;
use App\Models\Hirer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HirerRegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function candidateTriesToRegisterAsHirer()
    {
        $candidate = factory(Candidate::class)->create();

        $this->assertUnqiueEmailValidation($candidate->email);
    }

    /**
     * @test
     */
    public function hirerTriesToRegisterAgain()
    {
        $hirer = factory(Hirer::class)->create();

        $this->assertUnqiueEmailValidation($hirer->email);
    }

    /**
     * @test
     */
    public function brandAdminTriesToRegisterAsHirer()
    {
        $brandAdmin = factory(BrandAdmin::class)->create();

        $this->assertUnqiueEmailValidation($brandAdmin->email);
    }

    /**
     * @test
     */
    public function userFillsOutTheHomePageFormCorrectly()
    {
        $email = 'jon.smith@algoodbody.com';

        $this->visit(route('register'))
            ->fillsOutRegisterForm($email)
            ->seePageIs(route('hirer.register'))
            ->seeInDatabase('hirers', ['email' => $email])
            ->see('Thank you for registering');
    }

    /**
     * @test
     */
    public function userRegistersForLawFirmWithUnknownEmailDomain()
    {
        $email = 'jon.smith@gmail.com';

        $this->visit(route('register'))
            ->fillsOutRegisterForm($email)
            ->seePageIs(route('hirer.register'))
            ->dontSeeInDatabase('hirers', [
                'email' => $email,
                'email_verified' => false,
            ])
            ->see('Sorry your email address is not on a authorised list');

        $failed = FailedHirerRegistration::first();

        $this->assertNotNull($failed);
        $this->assertEquals($email, $failed->email);
        $this->assertEquals('', $failed->add_law_firm);
        $this->assertEquals(1, $failed->law_firm_id);
    }

    /**
     * @test
     */
    public function userRegistersWithUnkownLawFirm()
    {
        $email = 'jon.smith@gmail.com';

        $this->visit(route('register'))
            ->type('John', 'first_name')
            ->type('Smith', 'last_name')
            ->type($email, 'email')
            ->type('Add new law firm', 'add_law_firm')
            ->type('testpass', 'password')
            ->type('07712312312', 'telephone')
            ->press('register-hirer')
            ->seePageIs(route('hirer.register'))
            ->dontSeeInDatabase('hirers', [
                'email'          => $email,
                'email_verified' => false,
            ])
            ->see('Thank you, we will contact you shortly, to complete your registration, for your company');

        $failed = FailedHirerRegistration::first();

        $this->assertNotNull($failed);
        $this->assertEquals($email, $failed->email);
        $this->assertEquals('Add new law firm', $failed->add_law_firm);
        $this->assertNull($failed->law_firm_id);
    }

    /**
     * @test
     */
    public function userSubmitsBlankFormFromHomePage()
    {
        $this->visit(route('register'))
            ->press('register-hirer')
            ->seePageIs(route('hirer.register'))
            ->see('The first name field is required.')
            ->see('The last name field is required.')
            ->see('The email field is required.')
            ->see('The telephone field is required.')
            ->see('The company field is required.')
            ->see('The password field is required.');
    }

    protected function assertUnqiueEmailValidation($email)
    {
        $this->visit(route('register'))
            ->type($email, 'email')
            ->press('register-hirer')
            ->seePageIs(route('hirer.register'))
            ->see('The email has already been taken');

        return $this;
    }

    protected function fillsOutRegisterForm($email)
    {
        $this->type('John', 'first_name')
            ->type('Smith', 'last_name')
            ->type($email, 'email')
            ->select(1, 'law_firm_id')
            ->type('testpass', 'password')
            ->type('07712312312', 'telephone')
            ->press('register-hirer');

        return $this;
    }
}
