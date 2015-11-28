<?php

use App\Helpers\Api\ApiResult;

class VersionTest extends TestCase
{
    /** @var ApiResult $result */
    private $result;

    public function setUp()
    {
        parent::setUp();
        /** @var App\Handlers\Api\Version $api */
        $api = api('version');

        $this->result = $api->get();
    }

    /** @test */
    public function it_has_a_named_route()
    {
        $this->assertTrue(Route::has('api.version'));

        $uri = Route::getRoutes()->getByName('api.version')->getUri();
        $this->assertEquals('api/version', $uri);
    }

    /** @test */
    public function it_is_successful()
    {
        $this->assertTrue($this->result->isSuccessful());
    }

    /** @test */
    public function it_has_the_correct_version()
    {
        $this->assertContainsJson(['version' => 2], $this->result);
    }

    /** @test */
    public function it_returns_only_data_for_toArray_function()
    {
        $expected = [
            'version' => 2
        ];

        $this->assertEquals($expected, $this->result->toArray());
    }
}
