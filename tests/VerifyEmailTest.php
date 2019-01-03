<?php

use App\Models\Candidate;
use App\Models\Hirer;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VerifyEmailTest extends TestCase
{
    use DatabaseTransactions;

    protected $url = 'email/verify/%s';

    /**
     * @test
     */
    public function candidateVerifiesEmail()
    {
        $candidate = factory(Candidate::class)->create([
            'email_verified' => false,
            'is_live' => false,
        ]);

        $url = $this->getVerifyUrl($candidate->email_token);

        $this->visit($url)
            ->seePageIs(route('candidate.register.review'))
            ->seeInDatabase('candidates', [
                'email' => $candidate->email,
                'email_verified' => true,
            ]);
    }

    /**
     * @test
     */
    public function hirerVerifiesEmail()
    {
        $hirer = factory(Hirer::class)->create([
            'email_verified' => false,
        ]);

        $url = $this->getVerifyUrl($hirer->email_token);

        $this->visit($url)
            ->seePageIs(route('hirer.dashboard'))
            ->seeInDatabase('hirers', [
                'email' => $hirer->email,
                'email_verified' => true,
            ]);
    }

    protected function getVerifyUrl($token)
    {
        return sprintf($this->url, $token);
    }
}
