<?php


namespace App\Handlers\Api;


use App\Helpers\Api\ApiResult;

class Version extends ApiHandler
{
    public function get()
    {
        return new ApiResult([
            'version' => 2
        ]);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->get();
    }
}