<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Bot;

class BotTest extends AuthTestCase
{
    /** @var Bot $bot */
    protected $bot;

    public function setUp()
    {
        parent::setUp();
        $this->bot = factory(Bot::class)->create();
    }

    /** @test */
    public function it_has_a_default_status_of_offline()
    {
        $this->assertEquals('offline', $this->bot->status);
    }
}
