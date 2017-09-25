<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'https://localhost';

    public function actingAs(Illuminate\Contracts\Auth\Authenticatable $user, $guard = null)
    {
        $this->withSession(['guard' => $guard]);

        return parent::actingAs($user, $guard);
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('MAIL_PRETEND=true');

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function assertMatchDeleted($candidateId, $searchId)
    {
        $this->dontSeeInDatabase('candidate_search', [
            'candidate_id' => $candidateId,
            'search_id'    => $searchId,
        ]);

        return $this;
    }

    public function assertMatchUnsuccessful($candidateId, $searchId)
    {
        $this->seeInDatabase('candidate_search', [
            'candidate_id' => $candidateId,
            'search_id'    => $searchId,
            'status'       => config('match.unsuccessful'),
        ]);

        return $this;
    }
}
