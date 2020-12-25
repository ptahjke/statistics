<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

if (!isset($router)) {
    throw new RuntimeException('Router instance must be set');
}

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/statistics/site-visits', 'Statistics\SiteVisitStatisticsController@statistics');
$router->post('/statistics/site-visits', 'Statistics\SiteVisitStatisticsController@collect');
