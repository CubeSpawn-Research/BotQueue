<?php

return [

    'route' => [
        'prefix' => 'api', // Route Prefix
        'bindings' => [
//            'job' => App\Models\Job::class,
        ],
    ],

    'endpoints' => [
        'version' => App\Handlers\Api\Version::class,
        'jobs' => App\Handlers\Api\Jobs\Jobs::class,
        'queues.jobs' => App\Handlers\Api\Queues\Jobs::class,
        'bots' => App\Handlers\Api\Bots\Bots::class
    ],

];
