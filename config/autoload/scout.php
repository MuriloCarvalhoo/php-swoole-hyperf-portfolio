<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use function Hyperf\Support\env;

return [
    'default' => env('SCOUT_ENGINE', 'elasticsearch'),
    'chunk' => [
        'searchable' => 5000,
        'unsearchable' => 5000,
    ],
    'prefix' => env('SCOUT_PREFIX', ''),
    'soft_delete' => true,
    'concurrency' => 100,
    'engine' => [
        'elasticsearch' => [
            'driver' => Hyperf\Scout\Provider\ElasticsearchProvider::class,
            'index' => 'movies_index',
            'hosts' => [
                env('ELASTICSEARCH_HOST', 'http://127.0.0.1:9200'),
            ],
        ],
    ],
];
