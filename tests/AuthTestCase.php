<?php

use App\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTestCase extends TestCase
{
    use DatabaseMigrations;

    /** @var User $user */
    protected $user;

    public function setUp() {
        parent::setUp();

        $this->artisan('migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });

        $this->user = factory(App\User::class)->create();
        $this->actingAs($this->user);
    }
}
