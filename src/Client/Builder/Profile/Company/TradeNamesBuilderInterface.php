<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder\Profile\Company;

use Werkspot\KvkApi\Api\Profile\Company\TradeNames;

interface TradeNamesBuilderInterface
{
    public function fromArray(array $data): TradeNames;
}
