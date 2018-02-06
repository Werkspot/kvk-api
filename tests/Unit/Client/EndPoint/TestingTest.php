<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Endpoint;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Endpoint\MapperInterface;
use Werkspot\KvkApi\Client\Endpoint\Testing;

/**
 * @small
 */
final class TestingTest extends TestCase
{
    /**
     * @test
     * @dataProvider getEndpoints
     */
    public function canMapAllKeys(string $endpointKey):void
    {
        $endpoint = new Testing();
        $endpoint = $endpoint->map($endpointKey);

        self::assertNotNull($endpoint);
        self::assertContains(Testing::BASE_URL, $endpoint);
    }

    /**
     * @test
     * @expectedException \Werkspot\KvkApi\Client\Endpoint\Exception\EndpointCouldNotBeMappedException
     */
    public function mappingInvalidKeyThrowsException():void
    {
        $endpoint = new Testing();
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
