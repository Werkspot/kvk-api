<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder\Profile\Company;

use Werkspot\KvkApi\Api\Profile\Company\TradeNames;
use Werkspot\KvkApi\Client\Builder\AbstractBuilder;

final class TradeNamesBuilder extends AbstractBuilder implements TradeNamesBuilderInterface
{
    public function fromArray(array $data): TradeNames
    {
        return new TradeNames(
            $this->extractStringOrNull('businessName', $data),
            $this->extractStringOrNull('shortBusinessName', $data),
            $this->extractArrayOrNull('currentTradeNames', $data),
            $this->extractArrayOrNull('currentStatutoryNames', $data)
        );
    }
}
