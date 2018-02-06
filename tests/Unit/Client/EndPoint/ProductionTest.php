<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Endpoint;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Endpoint\MapperInterface;
use Werkspot\KvkApi\Client\Endpoint\Production;

/**
 * @small
 */
final class ProductionTest extends TestCase
{
    /**
     * @test
     * @dataProvider getEndpoints
     */
    public function canMapAllKeys(string $endpointKey):void
    {
        $endpoint = new Production();
        $endpoint = $endpoint->map($endpointKey);

        self::assertNotNull($endpoint);
        self::assertContains(Production::BASE_URL, $endpoint);
    }

    /**
     * @test
     * @expectedException \Werkspot\KvkApi\Client\Endpoint\Exception\EndpointCouldNotBeMappedException
     */
    public function mappingInvalidKeyThrowsException():void
    {
        $endpoint = new Production();
        $endpoint->map('invalid');
    }

    public function getEndpoints(): array
    {
        return [
            MapperInterface::PROFILE => [MapperInterface::PROFILE],
            MapperInterface::SEARCH => [MapperInterface::SEARCH],
        ];
    }
}
