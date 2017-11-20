<?php

use App\Models\BrandAdmin;
use App\Models\Candidate;
use App\Models\Hirer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CandidateRegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function candidateTriesToRegisterAgain()
    {
        $candidate = factory(Candidate::class)->create();

        $this->assertUnqiueEmailValidation($candidate->email);
    }

    /**
     * @test
     */
    public function hirerTriesToRegisterAsCandidate()
    {
        $hirer = factory(Hirer::class)->create();

        $this->assertUnqiueEmailValidation($hirer->email);
    }

    /**
     * @test
     */
    public function brandAdminTriesToRegisterAsCandidate()
    {
        $brandAdmin = factory(BrandAdmin::class)->create();

        $this->assertUnqiueEmailValidation($brandAdmin->email);
    }

    /**
     * @test
     */
    public function userFillsOutTheHomePageFormCorrectly()
    {
        $email = 'jon.smith@gmail.com';

        $this->visit(route('register'))
            ->fillsOutRegisterForm($email)
            ->seeInDatabase('candidates', [
                'email' => $email,
                'email_verified' => false,
            ])
            ->seePageIs(route('candidate.register.preferences'));
    }

    /**
     * @test
     */
    public function deletedCandidateRegistersAgain()
    {
        $candidate = factory(Candidate::class)->create([
            'email_verified' => true,
        ]);

        $candidate->delete();

        $this->visit(route('register'))
            ->fillsOutRegisterForm($candidate->email)
            ->seeInDatabase('candidates', [
                'email' => $candidate->email,
                'email_verified' => false,
            ])
            ->seePageIs(route('candidate.register.preferences'));
    }

    /**
     * @test
     */
    public function userSubmitsBlankFormFromHomePage()
    {
        $this->visit(route('register'))
            ->press('register-candidate')
            ->seePageIs(route('candidate.register'))
            ->see('The first name field is required.')
            ->see('The last name field is required.')
            ->see('The email field is required.')
            ->see('The password field is required.');
    }

    protected function assertUnqiueEmailValidation($email)
    {
        $this->visit(route('register'))
            ->type($email, 'email')
            ->press('register-candidate')
            ->seePageIs(route('candidate.register'))
            ->see('The email has already been taken');

        return $this;
    }

    protected function fillsOutRegisterForm($email)
    {
        $this->type('John', 'first_name')
            ->type('Smith', 'last_name')
            ->type($email, 'email')
            ->type('testpass', 'password')
            ->press('register-candidate');

        return $this;
    }
}
