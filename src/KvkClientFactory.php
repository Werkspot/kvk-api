<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Werkspot\KvkApi\Client\Factory\KvkPaginatorFactory;
use Werkspot\KvkApi\Client\Factory\Profile\Company\AddressFactory;
use Werkspot\KvkApi\Client\Factory\Profile\Company\BusinessActivityFactory;
use Werkspot\KvkApi\Client\Factory\Profile\Company\TradeNamesFactory;
use Werkspot\KvkApi\Client\Factory\Profile\CompanyFactory;
use Werkspot\KvkApi\Http\Adapter\Guzzle\Client as GuzzleClient;
use Werkspot\KvkApi\Http\ClientInterface;
use Werkspot\KvkApi\Http\Endpoint\MapperInterface;

final class KvkClientFactory
{
    public static function create(string $userKey, MapperInterface $endpoint): KvkClient
    {
        return new KvkClient(
            self::createHttpClient($userKey, $endpoint),
            self::createProfileResponseFactory()
        );
    }

    private static function createHttpClient(string $userKey, MapperInterface $endpoint): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->unshift(Middleware::mapRequest(function (RequestInterface $request) use ($userKey) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), 'user_key', $userKey));
        }));

        return new GuzzleClient(
            new \GuzzleHttp\Client(['handler' => $stack]),
            $endpoint
        );
    }

    private static function createProfileResponseFactory(): KvkPaginatorFactory
    {
        return new KvkPaginatorFactory(
            new CompanyFactory(
                new TradeNamesFactory(),
                new BusinessActivityFactory(),
                new AddressFactory()
            )
        );
    }
}
