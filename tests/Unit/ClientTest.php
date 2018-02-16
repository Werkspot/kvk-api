<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Client\Factory\KvkPaginatorFactoryInterface;
use Werkspot\KvkApi\Client\KvkPaginator;
use Werkspot\KvkApi\Http\ClientInterface;
use Werkspot\KvkApi\Http\Endpoint\MapperInterface;
use Werkspot\KvkApi\Http\Search\ProfileQuery;
use Werkspot\KvkApi\KvkClient;
use Werkspot\KvkApi\Tests\Unit\MockeryAssertionTrait;

/**
 * @small
 */
final class ClientTest extends TestCase
{
    use MockeryAssertionTrait;

    /**
     * @test
     */
    public function getProfile(): void
    {
        $profileQuery = new ProfileQuery();
        $response = $this->getResponse();
        $data = ['data'];
        $json = json_encode(['data' => $data]);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::PROFILE, $profileQuery)->once()->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);
        $profileResponseFactory = $this->getProfileResponseFactory();
        $profileResponseFactory->shouldReceive('fromProfileData')->with($data)->once()->andReturn($this->getProfileResponce());

        $client = new KvkClient($adapter, $profileResponseFactory);
        $client->getProfile($profileQuery);
    }

    /**
     * @test
     */
    public function getNextPage(): void
    {
        $response = $this->getResponse();
        $profileResponse = $this->getProfileResponce();
        $data = ['data'];
        $json = json_encode(['data' => $data]);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getUrl')->with($profileResponse->getNextUrl())->once()->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);
        $profileResponseFactory = $this->getProfileResponseFactory();
        $profileResponseFactory->shouldReceive('fromProfileData')->with($data)->once()->andReturn($this->getProfileResponce());

        $client = new KvkClient($adapter, $profileResponseFactory);
        $client->getNextPage($profileResponse);
    }

    /**
     * @test
     */
    public function getPreviousPage(): void
    {
        $response = $this->getResponse();
        $profileResponse = $this->getProfileResponce();
        $data = ['data'];
        $json = json_encode(['data' => $data]);

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getUrl')->with($profileResponse->getPreviousUrl())->once()->andReturn($response);
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);
        $profileResponseFactory = $this->getProfileResponseFactory();
        $profileResponseFactory->shouldReceive('fromProfileData')->with($data)->once()->andReturn($this->getProfileResponce());

        $client = new KvkClient($adapter, $profileResponseFactory);
        $client->getPreviousPage($profileResponse);
    }

    /**
     * @return MockInterface|ClientInterface
     */
    private function getAdapter()
    {
        return Mockery::mock(ClientInterface::class);
    }

    /**
     * @return MockInterface|KvkPaginatorFactoryInterface
     */
    private function getProfileResponseFactory()
    {
        return Mockery::mock(KvkPaginatorFactoryInterface::class);
    }

    /**
     * @return MockInterface|ResponseInterface
     */
    private function getResponse()
    {
        return Mockery::mock(ResponseInterface::class);
    }

    private function getProfileResponce(): KvkPaginator
    {
        return new KvkPaginator(
            1,
            2,
            3,
            [],
            'nextLink',
            'previousLink'
        );
    }
}
