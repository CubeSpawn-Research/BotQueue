<?php

if (! function_exists('api')) {
    /**
     * @param $api
     * @return \App\Helpers\Api\ApiResult
     */
    function api($api) {
        return Api::handle($api);
    }
}

if (! function_exists('js_data')) {
    function js_data($data) {
        /** @var App\Html\JsMessageBag $bag */
        $bag = app(App\Html\JsMessageBag::class);

        foreach($data as $key => $value) {
            $bag->add($key, $value);
        }
    }
}