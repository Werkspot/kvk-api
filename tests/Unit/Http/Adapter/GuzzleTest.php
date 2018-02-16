<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Tests\Unit\Http\Adapter;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Http\Adapter\Guzzle\Client;
use Werkspot\KvkApi\Http\Endpoint\MapperInterface;
use Werkspot\KvkApi\Http\Search\QueryInterface;
use Werkspot\KvkApi\Tests\Unit\MockeryAssertionTrait;

/**
 * @small
 */
final class GuzzleTest extends TestCase
{
    use MockeryAssertionTrait;

    /**
     * @test
     */
    public function getEndpoint(): void
    {
        $endpoint = MapperInterface::PROFILE;
        $url = 'http://example.com';
        $searchQueryOptions = 'searchQuery';
        $expectedOptions = ['query' => [$searchQueryOptions]];

        $urlMapper = $this->getMapper();
        $urlMapper->shouldReceive('map')->once()->with($endpoint)->andReturn($url);

        $searchQuery = $this->getSearchQuery();
        $searchQuery->shouldReceive('get')->once()->andReturn([$searchQueryOptions]);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, $expectedOptions)->andReturn($this->getResponse());

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getEndpoint($endpoint, $searchQuery);
    }

    /**
     * @test
     */
    public function getUrl(): void
    {
        $url = 'http://example.com';

        $urlMapper = $this->getMapper();

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, [])->andReturn($this->getResponse());

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getUrl($url);
    }

    /**
     * @test
     *
     * @expectedException \Werkspot\KvkApi\Exception\KvkApiException
     */
    public function getUrl_shouldThrowException(): void
    {
        $url = 'http://example.com';

        $urlMapper = $this->getMapper();

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, [])->andThrow(Mockery::Mock(RequestException::class));

        $adapter = new Client($guzzleClient, $urlMapper);
        $adapter->getUrl($url);
    }

    /**
     * @test
     */
    public function getJson(): void
    {
        $response = $this->getResponse();
        $response->shouldReceive('getBody')->once()->andReturnSelf();
        $response->shouldReceive('getContents')->once()->andReturn('');

        $adapter = new Client($this->getGuzzleClient(), $this->getMapper());
        $adapter->getJson($response);
    }

    /**
     * @return MockInterface|GuzzleClientInterface
     */
    private function getGuzzleClient()
    {
        return $guzzleClient = Mockery::mock(GuzzleClientInterface::class);
    }

    /**
     * @return MockInterface|MapperInterface
     */
    private function getMapper()
    {
        return $urlMapper = Mockery::mock(MapperInterface::class);
    }

    /**
     * @return MockInterface|QueryInterface
     */
    private function getSearchQuery()
    {
        return $urlMapper = Mockery::mock(QueryInterface::class);
    }

    /**
     * @return MockInterface|ResponseInterface
     */
    private function getResponse()
    {
        return Mockery::mock(ResponseInterface::class);
    }
}
