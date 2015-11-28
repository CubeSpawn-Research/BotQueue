<?php


namespace App\Helpers\Api;


use App\Handlers\Api\ApiHandler;

class ApiHelper
{
    /**
     * @param $api
     * @return ApiHandler
     */
    public function handle($api) {
        // We need to return an api result
        $apis = config('api.endpoints');
        $class = $apis[$api];
        return new $class;
    }

    private function success($data)
    {
        return new ApiResult($data);
    }
}