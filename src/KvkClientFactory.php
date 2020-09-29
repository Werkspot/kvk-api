<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use GuzzleHttp\Client;
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
    public static function create(
        string $userKey,
        MapperInterface $endpoint,
        ?string $rootCertificate = null
    ): KvkClient {
        return new KvkClient(
            self::createHttpClient($userKey, $endpoint, $rootCertificate),
            self::createProfileResponseFactory()
        );
    }

    private static function createHttpClient(
        string $userKey,
        MapperInterface $endpoint,
        ?string $rootCertificate = null
    ): ClientInterface {
        $stack = HandlerStack::create();
        $stack->unshift(Middleware::mapRequest(function (RequestInterface $request) use ($userKey) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), 'user_key', $userKey));
        }));

        if ($rootCertificate === null) {
            trigger_error('kvk-api: Not using a root certificate is deprecated and will be required in version 1.0. Please configure a root certificate.', E_USER_DEPRECATED);
        }

        $client = new Client([
            'verify' => $rootCertificate ?? false,
            'handler' => $stack,
        ]);

        return new GuzzleClient(
            $client,
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
