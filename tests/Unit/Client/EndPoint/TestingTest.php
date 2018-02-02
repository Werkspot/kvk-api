<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\EndPoint;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\EndPoint\MapperInterface;
use Werkspot\KvkApi\Client\EndPoint\Testing;

/**
 * @small
 */
final class TestingTest extends TestCase
{
    /**
     * @test
     * @dataProvider getEndpoints
     */
    public function canMapAllKeys(string $endPointKey):void
    {
        $endpoint = new Testing();
        $endpoint = $endpoint->map($endPointKey);

        self::assertNotNull($endpoint);
        self::assertContains(Testing::BASE_URL, $endpoint);
    }

    /**
     * @test
     * @expectedException \Werkspot\KvkApi\Client\EndPoint\Exception\EndpointCouldNotBeMappedException
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
