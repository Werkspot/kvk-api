<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder\Profile\Company;

use Werkspot\KvkApi\Api\Profile\Company\BusinessActivity;
use Werkspot\KvkApi\Client\Builder\AbstractBuilder;

final class BusinessActivityBuilder extends AbstractBuilder implements BusinessActivityBuilderInterface
{
    /**
     * @return BusinessActivity[]
     */
    public function fromArray(array $data): array
    {
        $businessActivities = [];
        foreach ($data as $businessActivity) {
            $businessActivities[] = $this->buildFromArray($businessActivity);
        }

        return $businessActivities;
    }

    private function buildFromArray(array $data): BusinessActivity
    {
        return new BusinessActivity(
            $this->extractIntegerOrNull('sbiCode', $data),
            $this->extractStringOrNull('sbiCodeDescription', $data),
            $this->extractBoolean('isMainSbi', $data)
        );
    }
}
