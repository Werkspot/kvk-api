<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use Werkspot\KvkApi\Api\ProfileResponse;
use Werkspot\KvkApi\Api\ResponseInterface;
use Werkspot\KvkApi\Client\Adapter\AdapterInterface;
use Werkspot\KvkApi\Client\Builder\ProfileResponseBuilderInterface;
use Werkspot\KvkApi\Client\Endpoint\MapperInterface;
use Werkspot\KvkApi\Client\Search\ProfileQuery;

final class Client
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * @var ProfileResponseBuilderInterface
     */
    private $profileResponseBuilder;

    public function __construct(AdapterInterface $adapter, ProfileResponseBuilderInterface $profileResponseBuilder)
    {
        $this->adapter = $adapter;
        $this->profileResponseBuilder = $profileResponseBuilder;
    }

    public function getProfile(ProfileQuery $profileQuery): ProfileResponse
    {
        $json = $this->adapter->getJson($this->adapter->getEndpoint(MapperInterface::PROFILE, $profileQuery));
        $data = json_decode($json, true)['data'];

        return $this->profileResponseBuilder->fromData($data);
    }

    public function getNextPage(ResponseInterface $response): ResponseInterface
    {
        $json = $this->adapter->getJson($this->adapter->getUrl($response->getNextUrl()));
        $data = json_decode($json, true)['data'];

        return $this->profileResponseBuilder->fromData($data);
    }

    public function getPreviousPage(ResponseInterface $response): ResponseInterface
    {
        $json = $this->adapter->getJson($this->adapter->getUrl($response->getPreviousUrl()));
        $data = json_decode($json, true)['data'];

        return $this->profileResponseBuilder->fromData($data);
    }
}
