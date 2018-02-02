<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\EndPoint;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\EndPoint\MapperInterface;
use Werkspot\KvkApi\Client\EndPoint\Production;

/**
 * @small
 */
final class ProductionTest extends TestCase
{
    /**
     * @test
     * @dataProvider getEndpoints
     */
    public function canMapAllKeys(string $endPointKey):void
    {
        $endpoint = new Production();
        $endpoint = $endpoint->map($endPointKey);

        self::assertNotNull($endpoint);
        self::assertContains(Production::BASE_URL, $endpoint);
    }

    /**
     * @test
     * @expectedException \Werkspot\KvkApi\Client\EndPoint\Exception\EndpointCouldNotBeMappedException
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
