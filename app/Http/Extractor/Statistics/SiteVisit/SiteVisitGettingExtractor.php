<?php

declare(strict_types=1);

namespace App\Http\Extractor\Statistics\SiteVisit;

use App\Services\Statistics\SiteVisit\DTO\SiteVisitStatisticsDTO;

final class SiteVisitGettingExtractor
{
    /**
     * @param SiteVisitStatisticsDTO ...$siteVisitStatisticsDTOs
     * @return array
     */
    public function extract(SiteVisitStatisticsDTO ...$siteVisitStatisticsDTOs): array
    {
        $result = [];
        foreach ($siteVisitStatisticsDTOs as $siteVisitStatisticsDTO) {
            $result[$siteVisitStatisticsDTO->getCountryCode()] = $siteVisitStatisticsDTO->getVisitCount();
        }

        return $result;
    }
}
