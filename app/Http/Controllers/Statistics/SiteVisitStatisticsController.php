<?php

declare(strict_types=1);

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Extractor\Statistics\SiteVisit\SiteVisitGettingExtractor;
use App\Http\Request\Statistics\SiteVisitCollectingRequest;
use App\Services\Statistics\SiteVisit\SiteVisitStatistics;
use Illuminate\Http\JsonResponse;

class SiteVisitStatisticsController extends Controller
{
    /**
     * @param SiteVisitStatistics $siteVisitStatistics
     * @param SiteVisitGettingExtractor $siteVisitGettingExtractor
     * @return JsonResponse
     */
    public function statistics(
        SiteVisitStatistics $siteVisitStatistics,
        SiteVisitGettingExtractor $siteVisitGettingExtractor
    ): JsonResponse {
        $statistics = $siteVisitStatistics->get();

        return new JsonResponse(
            $siteVisitGettingExtractor->extract(...$statistics)
        );
    }

    /**
     * @param SiteVisitCollectingRequest $collectingRequest
     * @param SiteVisitStatistics $siteVisitStatistics
     */
    public function collect(
        SiteVisitCollectingRequest $collectingRequest,
        SiteVisitStatistics $siteVisitStatistics
    ): void {
        // данный сервис можно убрать в очередь, если количество статистики будет расти
        $siteVisitStatistics->collect($collectingRequest->getCityCode());
    }
}
