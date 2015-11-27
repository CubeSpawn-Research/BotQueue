<?php

return [

    'route' => [
        'prefix' => 'api', // Route Prefix
        'bindings' => [
//            'job' => App\Models\Job::class,
        ],
    ],

    'api' => [
        'version' => App\Handlers\Api\Version::class,
        'jobs' => App\Handlers\Api\Jobs\Jobs::class,
//        'job/{job}/create' => App\Handlers\Api\Job\Create::class,
    ],

];
