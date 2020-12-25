<?php

declare(strict_types=1);

namespace App\Services\Statistics\SiteVisit\DTO;

class SiteVisitStatisticsDTO
{
    private string $cityCode;
    private int $visitCount;

    /**
     * @param string $cityCode
     * @param int $visitCount
     */
    public function __construct(string $cityCode, int $visitCount)
    {
        $this->cityCode = $cityCode;
        $this->visitCount = $visitCount;
    }

    /**
     * @return string
     */
    public function getCityCode(): string
    {
        return $this->cityCode;
    }

    /**
     * @return int
     */
    public function getVisitCount(): int
    {
        return $this->visitCount;
    }
}
