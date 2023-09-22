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
use Hyperf\HttpServer\Router\Router;
use function Hyperf\ViewEngine\view;

Router::get('/', function () {
    return view('welcome');
});

Router::get('titles', [App\Controller\TitleController::class, 'index']);
Router::get('titles/get', [App\Controller\TitleController::class, 'get']);
