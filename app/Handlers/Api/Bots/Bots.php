<?php


namespace App\Handlers\Api\Bots;


use App\Handlers\Api\ApiHandler;
use App\Helpers\Api\ApiResult;
use App\Models\Bot;

class Bots extends ApiHandler
{
    public function __construct()
    {
        $this->query = Bot::query();
    }

    public function get()
    {
        return new ApiResult($this->query->get()->toArray());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->get()->toArray();
    }
}