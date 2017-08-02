<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\NqAdmin;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CandidateProfileDetailsTest extends TestCase
{
    use DatabaseTransactions;

    protected $candidate;

    public function setUp()
    {
        parent::setUp();

        /*
         * do let telephone be random because there is a format enforced on the
         * field which will cause the test to fail is the number doest have a space
         */
        $this->candidate = factory(Candidate::class)->create([
            'telephone' => '07712 345678'
        ]);
    }

    /**
     * @test
     */
    public function userFillsOutFormCorrectly()
    {
        $data = [
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'jon.smith@gmail.com',
            'telephone' => '01923277402',
        ];

        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.profile.details'))
            ->seeInField('first_name', $this->candidate->first_name)
            ->seeInField('last_name', $this->candidate->last_name)
            ->seeInField('email', $this->candidate->email)
            ->seeInField('telephone', $this->candidate->telephone)
            ->type($data['first_name'], 'first_name')
            ->type($data['last_name'], 'last_name')
            ->type($data['email'], 'email')
            ->type($data['telephone'], 'telephone')
            ->press('Update')
            ->seeInDatabase('candidates', $data)
            ->seePageIs(route('candidate.profile'));
    }

    /**
     * @test
     */
    public function userSubmitsBlankForm()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.profile.details'))
            ->type('', 'first_name')
            ->type('', 'last_name')
            ->type('', 'email')
            ->type('', 'telephone')
            ->press('Update')
            ->seePageIs(route('candidate.profile.details'))
            ->see('The first name field is required.')
            ->see('The last name field is required.')
            ->see('The email field is required.')
            ->see('The telephone field is required.');
    }

    /**
     * @test
     */
    public function userWhoHasAllRequiredDataSubmitsFormWithoutUpdatingDetails()
    {
        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.profile.details'))
            ->press('Update')
            ->seePageIs(route('candidate.profile'));
    }

    /**
     * @test
     */
    public function userTriesToChangeEmailToRegisteredCandidate()
    {
        $candidate = factory(Candidate::class)->create();

        $this->assertUnqiueEmailValidation($candidate->email);
    }

    /**
     * @test
     */
    public function userTriesToChangeEmailToRegisteredHirer()
    {
        $hirer = factory(Hirer::class)->create();

        $this->assertUnqiueEmailValidation($hirer->email);
    }

    /**
     * @test
     */
    public function userTriesToChangeEmailToRegisteredNqAdmin()
    {
        $nqAdmin = factory(NqAdmin::class)->create();

        $this->assertUnqiueEmailValidation($nqAdmin->email);
    }

    protected function assertUnqiueEmailValidation($email)
    {
        $this->actingAs($this->candidate, 'candidates')
            ->visit(route('candidate.profile.details'))
            ->type($email, 'email')
            ->press('Update')
            ->seePageIs(route('candidate.profile.details'))
            ->see('The email has already been taken');

        return $this;
    }
}
