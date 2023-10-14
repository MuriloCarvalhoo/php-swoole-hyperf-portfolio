<?php

declare(strict_types=1);
use function Hyperf\Support\env;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'default' => [
        'handler' => [
            'class' => Monolog\Handler\StreamHandler::class,
            'constructor' => [
                'stream' => BASE_PATH . '/runtime/logs/hyperf.log',
                'level' => Monolog\Logger::ERROR,

            ],
        ],
        'formatter' => [
            'class' => Monolog\Formatter\LineFormatter::class,
            'constructor' => [
                'format' => "||%datetime%||%channel%||%level_name%||%message%||%context%||%extra%\n",
                'dateFormat' => 'Y-m-d H:i:s',
                'allowInlineLineBreaks' => true,
                'includeStacktraces' => true,
            ],
        ],
    ]
];
