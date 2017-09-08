<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\BrandAdmin;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function candidateLogsIn()
    {
        $this->assertUserLogsInAndRedirects(Candidate::class, 'candidate.dashboard');
    }

    /**
     * @test
     */
    public function candidateWithoutVerifiedEmailCantLogin()
    {
        $this->assertUserWithoutVerifiedCantLogin(Candidate::class);
    }

    /**
     * @test
     */
    public function hirerLogsIn()
    {
        $this->assertUserLogsInAndRedirects(Hirer::class, 'hirer.dashboard');
    }

    /**
     * @test
     */
    public function hirerWithoutVerifiedEmailCantLogin()
    {
        $this->assertUserWithoutVerifiedCantLogin(Hirer::class);
    }

    /**
     * @test
     */
    public function brandAdminLogsIn()
    {
        $this->assertUserLogsInAndRedirects(BrandAdmin::class, 'brand-admin.dashboard');
    }

    /**
     * @test
     */
    public function trottlesLogin()
    {
        $password = 'testpass';

        $user = factory(BrandAdmin::class)->create([
            'password' => bcrypt($password),
        ]);

        for ($i = 0; $i < 10; $i++) {
            $this->visit(route('home'))
                ->fillOutLoginForm($user->email, 'notpassword');
        }

        //add assert seePageIs throttle error
    }

    protected function assertUserLogsInAndRedirects($userClass, $route)
    {
        $password = 'testpass';

        $user = factory($userClass)->create([
            'password' => bcrypt($password),
        ]);

        $this->visit(route('home'))
            ->fillOutLoginForm($user->email, $password)
            ->seePageIs(route($route));
    }

    protected function assertUserWithoutVerifiedCantLogin($userClass)
    {
        $password = 'testpass';

        $user = factory($userClass)->create([
            'email_verified' => false,
            'password' => bcrypt($password),
        ]);

        $this->visit(route('home'))
            ->fillOutLoginForm($user->email, $password)
            ->seePageIs(url('login'))
            ->see('These credentials do not match our records.');
    }

    protected function fillOutLoginForm($email, $password)
    {
        $this->type($email, 'email')
            ->type($password, 'password')
            ->press('login-button');

        return $this;
    }
}
