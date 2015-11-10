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
    public function it_is_successful()
    {
        $this->assertTrue($this->result->success);
    }

    /** @test */
    public function it_has_the_correct_version()
    {
        $this->assertEquals(['version' => 2], $this->result->data);
    }

    /** @test */
    public function it_returns_both_success_and_data()
    {
        $expected = [
            'status' => 'success',
            'data' => [
                'version' => 2
            ]
        ];

        $this->assertEquals($expected, $this->result->toArray());
    }
}
