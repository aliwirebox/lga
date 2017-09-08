<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\BrandAdmin;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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

        $this->visit(route('home'))
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

        $this->visit(route('home'))
            ->fillsOutRegisterForm($email)
            ->seePageIs(route('hirer.register'))
            ->dontSeeInDatabase('hirers', [
                'email' => $email,
                'email_verified' => false,
            ])
            ->see('Sorry your email address is not on a authorised list');
    }

    /**
     * @test
     */
    public function userSubmitsBlankFormFromHomePage()
    {
        $this->visit(route('home'))
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
        $this->visit(route('home'))
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
