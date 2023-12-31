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
Router::get('/get/genres', [App\Controller\GetController::class, 'genres']);

Router::addGroup('/titles/', function (){
    Router::get('index', [App\Controller\TitleController::class, 'index']);
    Router::get('get', [App\Controller\TitleController::class, 'get']);
    Router::post('store',   [App\Controller\TitleController::class, 'store']);
    Router::put('update/{titleId}',   [App\Controller\TitleController::class, 'update']);
    Router::delete('delete/{titleId}',  [App\Controller\TitleController::class, 'delete']);
});

Router::addGroup('/movies/', function (){
    Router::get('index', [App\Controller\MovieController::class, 'index']);
    Router::get('get', [App\Controller\MovieController::class, 'get']);
    Router::get('get-elastic', [App\Controller\MovieController::class, 'getElastic']);

    Router::get('main', [App\Controller\MovieController::class, 'main']);
    Router::get('detail/{id}',   [App\Controller\MovieController::class, 'detail']);
    Router::get('my-list',   [App\Controller\MovieController::class, 'myList']);
    Router::get('url-img/{tconst}',   [App\Controller\MovieController::class, 'getURlImg']);
});
