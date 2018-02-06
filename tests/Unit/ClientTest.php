<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Api\ProfileResponse;
use Werkspot\KvkApi\Client;
use Werkspot\KvkApi\Client\Adapter\AdapterInterface;
use Werkspot\KvkApi\Client\Builder\ProfileResponseBuilderInterface;
use Werkspot\KvkApi\Client\Endpoint\MapperInterface;
use Werkspot\KvkApi\Client\Search\ProfileQuery;
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
        $profileResponseBuilder = $this->getProfileResponseBuilder();
        $profileResponseBuilder->shouldReceive('fromData')->with($data)->once()->andReturn($this->getProfileResponce());

        $client = new Client($adapter, $profileResponseBuilder);
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
        $profileResponseBuilder = $this->getProfileResponseBuilder();
        $profileResponseBuilder->shouldReceive('fromData')->with($data)->once()->andReturn($this->getProfileResponce());

        $client = new Client($adapter, $profileResponseBuilder);
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
        $profileResponseBuilder = $this->getProfileResponseBuilder();
        $profileResponseBuilder->shouldReceive('fromData')->with($data)->once()->andReturn($this->getProfileResponce());

        $client = new Client($adapter, $profileResponseBuilder);
        $client->getPreviousPage($profileResponse);
    }

    /**
     * @return MockInterface|AdapterInterface
     */
    private function getAdapter()
    {
        return Mockery::mock(AdapterInterface::class);
    }

    /**
     * @return MockInterface|ProfileResponseBuilderInterface
     */
    private function getProfileResponseBuilder()
    {
        return Mockery::mock(ProfileResponseBuilderInterface::class);
    }

    /**
     * @return MockInterface|ResponseInterface
     */
    private function getResponse()
    {
        return Mockery::mock(ResponseInterface::class);
    }

    private function getProfileResponce(): ProfileResponse
    {
        return new ProfileResponse(
            1,
            2,
            3,
            [],
            'nextLink',
            'previousLink'
        );
    }
}
