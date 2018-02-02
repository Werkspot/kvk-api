<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Tests\Unit\Client\Adapter;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Client\Adapter\Guzzle;
use Werkspot\KvkApi\Client\Authentication\AuthenticationInterface;
use Werkspot\KvkApi\Client\EndPoint\MapperInterface;
use Werkspot\KvkApi\Client\Search\QueryInterface;
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
    public function getEndPoint(): void
    {
        $endPoint = MapperInterface::PROFILE;
        $url = 'http://example.com';
        $searchQueryOptions = 'searchQuery';
        $authenticationHeader = 'authenticationHeader';

        $expectedOptions = ['query' => [$searchQueryOptions], 'headers' => [$authenticationHeader]];

        $urlMapper = $this->getMapper();
        $urlMapper->shouldReceive('map')->once()->with($endPoint)->andReturn($url);

        $searchQuery = $this->getSearchQuery();
        $searchQuery->shouldReceive('get')->once()->andReturn([$searchQueryOptions]);

        $authentication = $this->getAuthentication();
        $authentication->shouldReceive('getHeader')->once()->andReturn($authenticationHeader);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, $expectedOptions)->andReturn($this->getResponse());

        $adapter = new Guzzle($guzzleClient, $authentication, $urlMapper);
        $adapter->getEndPoint($endPoint, $searchQuery);
    }

    /**
     * @test
     */
    public function getUrl(): void
    {
        $url = 'http://example.com';
        $authenticationHeader = 'authenticationHeader';
        $expectedOptions = ['headers' => [$authenticationHeader]];

        $urlMapper = $this->getMapper();

        $authentication = $this->getAuthentication();
        $authentication->shouldReceive('getHeader')->once()->andReturn($authenticationHeader);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, $expectedOptions)->andReturn($this->getResponse());

        $adapter = new Guzzle($guzzleClient, $authentication, $urlMapper);
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
        $authenticationHeader = 'authenticationHeader';
        $expectedOptions = ['headers' => [$authenticationHeader]];

        $urlMapper = $this->getMapper();

        $authentication = $this->getAuthentication();
        $authentication->shouldReceive('getHeader')->once()->andReturn($authenticationHeader);

        $guzzleClient = $this->getGuzzleClient();
        $guzzleClient->shouldReceive('get')->once()->with($url, $expectedOptions)->andThrow(Mockery::Mock(RequestException::class));

        $adapter = new Guzzle($guzzleClient, $authentication, $urlMapper);
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

        $adapter = new Guzzle($this->getGuzzleClient(), $this->getAuthentication(), $this->getMapper());
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
     * @return MockInterface|AuthenticationInterface
     */
    private function getAuthentication()
    {
        return $authentication = Mockery::mock(AuthenticationInterface::class);
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
