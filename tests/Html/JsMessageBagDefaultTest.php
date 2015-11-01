<?php

use App\Html\JsMessageBag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JsMessageBagDefaultTest extends TestCase
{
    /** @var JsMessageBag $bag */
    protected $bag;

    public function setUp()
    {
        $this->bag = new JsMessageBag();
    }

    /** @test */
    public function it_by_default_is_empty()
    {
        $this->assertTrue($this->bag->isEmpty());
    }

    /** @test */
    public function it_by_default_has_a_count_of_0()
    {
        $this->assertEquals(0, $this->bag->count());
    }

    /** @test */
    public function it_by_default_has_no_keys()
    {
        $this->assertEmpty($this->bag->keys());
    }

    /** @test */
    public function it_can_become_an_array()
    {
        $this->assertEquals([], $this->bag->toArray());
    }

    /** @test */
    public function it_can_become_json()
    {
        $this->assertEquals('{}', $this->bag->toJson());
    }
}
