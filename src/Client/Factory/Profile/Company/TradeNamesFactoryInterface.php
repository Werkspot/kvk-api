<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Factory\Profile\Company;

use Werkspot\KvkApi\Client\Profile\Company\TradeNames;

interface TradeNamesFactoryInterface
{
    public function fromArray(array $data): TradeNames;
}
