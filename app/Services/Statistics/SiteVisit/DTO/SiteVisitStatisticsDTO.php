<?php

declare(strict_types=1);

namespace App\Services\Statistics\SiteVisit\DTO;

class SiteVisitStatisticsDTO
{
    private string $countryCode;
    private int $visitCount;

    /**
     * @param string $countryCode
     * @param int $visitCount
     */
    public function __construct(string $countryCode, int $visitCount)
    {
        $this->countryCode = $countryCode;
        $this->visitCount = $visitCount;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return int
     */
    public function getVisitCount(): int
    {
        return $this->visitCount;
    }
}
