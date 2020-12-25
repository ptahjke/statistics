<?php

declare(strict_types=1);

namespace App\Services\Statistics\SiteVisit;

use App\Services\Statistics\SiteVisit\DTO\SiteVisitStatisticsDTO;
use Illuminate\Redis\RedisManager;

/*
 обработку ошибок не вижу смысла тут делать, т.к. в глобавльном обработчике идет логирование
 если же нам нужны будут кастомные логи, то можно легко инжектировать psr LoggerInterface
 и добавить нужное логирование
 если в добавок нужно показать пользователю кастомное сообщение -
 то я бы сделал кастомный экспешнк (унаследованный от общего абстрактного исключения или интерфейса) с нужным текстом
 добавил бы обработку таких исключений в глобавльном обработчике и отдавал бы текст таких исключений на ружу
*/
final class RedisSiteVisitStatistics implements SiteVisitStatistics
{
    private const CACHE_KEY_SITE_VISIT_STATISTICS = 'SITE_VISIT_STATISTICS';
    // сделал значение статическим - т.е. 1 посещение на 1 запрос
    // для какой-нибудь консольной команды, где нужно больше 1 посещения за раз фиксировать -
    // можно рашсышить сигнатуру @see \App\Services\Statistics\SiteVisit\RedisSiteVisitStatistics::collect
    private const VISIT_COUNT = 1;

    private RedisManager $redisManager;

    /**
     * По хорошему тут не должно быть привязки к инфраструктуре фреймворвка
     * но для MVP подойдет
     * @param RedisManager $redisManager
     */
    public function __construct(
        RedisManager $redisManager
    ) {
        $this->redisManager = $redisManager;
    }

    /**
     * @return SiteVisitStatisticsDTO[]
     */
    public function get(): array
    {
        $statistics = $this->redisManager->hgetall(self::CACHE_KEY_SITE_VISIT_STATISTICS);

        $result = [];
        foreach ($statistics as $cityCode => $visitCount) {
            $result[] = new SiteVisitStatisticsDTO($cityCode, (int) $visitCount);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function collect(string $cityCode): void
    {
        if ($this->redisManager->hexists(self::CACHE_KEY_SITE_VISIT_STATISTICS, $cityCode)) {
            $this->redisManager->hincrby(self::CACHE_KEY_SITE_VISIT_STATISTICS, $cityCode, self::VISIT_COUNT);
        } else {
            $this->redisManager->hset(self::CACHE_KEY_SITE_VISIT_STATISTICS, $cityCode, self::VISIT_COUNT);
        }
    }
}
