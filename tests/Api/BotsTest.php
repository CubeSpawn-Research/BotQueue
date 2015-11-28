<?php

use App\Models\Bot;

class BotsTest extends AuthTestCase
{
    protected $user;

    /** @test */
    public function it_has_a_named_route()
    {
        $this->assertTrue(Route::has('api.bots'));

        $uri = Route::getRoutes()->getByName('api.bots')->getUri();
        $this->assertEquals('api/bots', $uri);
    }

    /** @test */
    public function it_has_the_least_possible_info()
    {
        /** @var Job $bot */
        $bot = factory(Bot::class)->create();

        /** @var \App\Handlers\Api\Bots\Bots $bots */
        $bots = api('bots');

        $this->assertContainsJson([
                'id' => "{$bot->id}",
                'name' => "{$bot->name}",
                'status' => "offline"
            ], $bots->toArray());
    }
}
