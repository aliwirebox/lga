<?php

use App\Models\Candidate;
use App\Models\Hirer;
use App\Models\BrandAdmin;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserResetsPasswordTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * This test is to fix issue#447. Where users can
     * get stuck if they have ignored the verification
     * email.
     */
    public function candidateCanResetPasswordAndVerifyEmail()
    {
        $this->assertPasswordResetVerifiesEmail(Candidate::class, 'candidates');
    }

    /**
     * @test
     * This test is to fix issue#447. Where users can
     * get stuck if they have ignored the verification
     * email.
     */
    public function hirerCanResetPasswordAndVerifyEmail()
    {
        $this->assertPasswordResetVerifiesEmail(Hirer::class, 'hirers');
    }

    /**
     * @test
     */
    public function brandAdminCanResetPassword()
    {
        factory(BrandAdmin::class)->create([
            'email' => 'test@test.com',
        ]);

        DB::table('password_resets')->insert(['email' => 'test@test.com', 'token' => '1234']);

        $link = url('password/reset', '1234') . '?email=' . urlencode('test@test.com');

        $this->visit($link)
            ->type('new-password', 'password')
            ->type('new-password', 'password_confirmation')
            ->press('submit-password-reset')
            ->assertResponseStatus(200);
    }

    public function assertPasswordResetVerifiesEmail($userClass, $dbTable)
    {
        $user = factory($userClass)->create([
            'password'       => bcrypt('old-password'),
            'email_verified' => false,
            'email'          => 'test@test.com',
        ]);

        DB::table('password_resets')->insert(['email' => 'test@test.com', 'token' => '1234']);

        $link = url('password/reset', '1234') . '?email=' . urlencode('test@test.com');

        $this->visit($link)
            ->type('new-password', 'password')
            ->type('new-password', 'password_confirmation')
            ->press('submit-password-reset')
            ->assertResponseStatus(200)
            ->seeInDatabase($dbTable, [
                'email'          => 'test@test.com',
                'email_verified' => true,
            ]);
    }
}
