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
use Werkspot\KvkApi\Test\Unit\MockeryAssertionTrait;
use function json_encode;

/**
 * @small
 *
 * @internal
 */
final class KvkClientTest extends TestCase
{
    use MockeryAssertionTrait;

    /**
     * @test
     */
    public function get_profile(): void
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
    public function get_profile_can_handle_api_errors(): void
    {
        $code = 404;
        $message = 'NotFound';
        $reason = 'No companies found for the given query.';
        $profileQuery = new ProfileQuery();
        $response = $this->getResponse();
        $json = <<<RESPONSE
{
  "apiVersion": "2.0",
  "meta": {},
  "error": {
    "code": $code,
    "message": "$message",
    "reason": "$reason"
  }
}
RESPONSE;

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::PROFILE, $profileQuery)->once()->andReturn(
            $response
        );
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);

        $client = new KvkClient($adapter, $this->getProfileResponseFactory());
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage($message . ': ' . $reason);
        $client->getProfile($profileQuery);
    }

    /**
     * @test
     */
    public function get_profile_can_handle_unknown_payload(): void
    {
        $profileQuery = new ProfileQuery();
        $response = $this->getResponse();
        $json = <<<RESPONSE
{
  "apiVersion": "2.0",
  "meta": {},
  "bladibla": "bladibla"
}
RESPONSE;

        $adapter = $this->getAdapter();
        $adapter->shouldReceive('getEndpoint')->with(MapperInterface::PROFILE, $profileQuery)->once()->andReturn(
            $response
        );
        $adapter->shouldReceive('getJson')->with($response)->once()->andReturn($json);

        $client = new KvkClient($adapter, $this->getProfileResponseFactory());
        $this->expectExceptionMessageRegExp('/^Unknown payload.*/');
        $client->getProfile($profileQuery);
    }

    /**
     * @test
     */
    public function get_next_page(): void
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
    public function get_previous_page(): void
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