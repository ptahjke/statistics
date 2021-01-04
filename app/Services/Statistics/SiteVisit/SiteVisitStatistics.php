<?php

declare(strict_types=1);

namespace App\Services\Statistics\SiteVisit;

use App\Services\Statistics\SiteVisit\DTO\SiteVisitStatisticsDTO;

interface SiteVisitStatistics
{
    /**
     * @return SiteVisitStatisticsDTO[]
     */
    public function get(): array;

    /**
     * @param string $countryCode
     */
    public function collect(string $countryCode): void;
}
