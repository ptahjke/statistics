<?php

namespace App\Providers;

use App\Services\Statistics\SiteVisit\RedisSiteVisitStatistics;
use App\Services\Statistics\SiteVisit\SiteVisitStatistics;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(SiteVisitStatistics::class, static function($app) {
            $config = $app->make('config')->get('database.redis', []);

            $redisManager = new RedisManager($app, Arr::pull($config, 'client', 'predis'), $config);

            return new RedisSiteVisitStatistics($redisManager);
        });
    }
}
