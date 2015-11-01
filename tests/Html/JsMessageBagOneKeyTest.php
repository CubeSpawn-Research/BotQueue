<?php

use App\Html\JsMessageBag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JsMessageBagOneKeyTest extends TestCase
{
    /** @var JsMessageBag $bag */
    protected $bag;

    public function setUp()
    {
        $this->bag = new JsMessageBag();
        $this->bag->add('test', [
            'a' => 'b',
            'c' => 1
        ]);
    }

    /** @test */
    public function it_has_a_count_of_1()
    {
        $this->assertEquals(1, $this->bag->count());
    }

    /** @test */
    public function it_has_one_key()
    {
        $this->assertEquals(1, count($this->bag->keys()));
    }

    /** @test */
    public function it_has_the_test_key()
    {
        $this->assertTrue($this->bag->has('test'));
        $this->assertContains('test', $this->bag->keys());
    }

    /** @test */
    public function it_can_get_the_data_from_the_key()
    {
        $this->assertEquals([
            'a' => 'b',
            'c' => 1
        ], $this->bag->get('test'));
    }

    /** @test */
    public function first_is_a_synonym_for_get()
    {
        $this->assertEquals($this->bag->get('test'),
            $this->bag->first('test'));
    }

    /** @test */
    public function it_can_become_an_array()
    {
        $this->assertEquals([
            'test' => [
                'a' => 'b',
                'c' => 1
            ]
        ], $this->bag->toArray());
    }
    
    /** @test */
    public function it_can_become_json()
    {
        $expected = '{"test":{"a":"b","c":1}}';

        $this->assertEquals($expected, $this->bag->toJson());
    }

    /** @test */
    public function adding_conflicting_key_updates()
    {
        $this->bag->add('test', ['c' => 2]);

        $this->assertContainsKey('a', $this->bag->get('test'));
        $this->assertEquals('b', $this->bag->get('test')['a']);

        $this->assertContainsKey('c', $this->bag->get('test'));
        $this->assertEquals(2, $this->bag->get('test')['c']);
    }
}
