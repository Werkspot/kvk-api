<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use Werkspot\KvkApi\Client\Adapter\AdapterInterface;
use Werkspot\KvkApi\Client\Builder\Profile\Company\AddressBuilder;
use Werkspot\KvkApi\Client\Builder\Profile\Company\BusinessActivityBuilder;
use Werkspot\KvkApi\Client\Builder\Profile\Company\TradeNamesBuilder;
use Werkspot\KvkApi\Client\Builder\Profile\CompanyBuilder;
use Werkspot\KvkApi\Client\Builder\ProfileResponseBuilder;

final class ClientFactory
{
    public static function getClient(AdapterInterface $adapter): Client
    {
        $profileResponseBuilder =  new ProfileResponseBuilder(
            new CompanyBuilder(
                new TradeNamesBuilder(),
                new BusinessActivityBuilder(),
                new AddressBuilder()
            )
        );

        return new Client(
            $adapter,
            $profileResponseBuilder
        );
    }
}
