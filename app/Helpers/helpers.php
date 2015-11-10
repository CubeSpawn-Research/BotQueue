<?php

if (! function_exists('api')) {
    function api($api) {
        return Api::handle($api);
    }
}