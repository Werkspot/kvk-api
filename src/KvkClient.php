<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use Werkspot\KvkApi\Client\Factory\KvkPaginatorFactoryInterface;
use Werkspot\KvkApi\Client\KvkPaginator;
use Werkspot\KvkApi\Client\KvkPaginatorInterface;
use Werkspot\KvkApi\Http\ClientInterface;
use Werkspot\KvkApi\Http\Endpoint\MapperInterface;
use Werkspot\KvkApi\Http\Search\ProfileQuery;

final class KvkClient
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var KvkPaginatorFactoryInterface
     */
    private $profileResponseFactory;

    public function __construct(ClientInterface $httpClient, KvkPaginatorFactoryInterface $profileResponseFactory)
    {
        $this->httpClient = $httpClient;
        $this->profileResponseFactory = $profileResponseFactory;
    }

    public function getProfile(ProfileQuery $profileQuery): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::PROFILE, $profileQuery));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    public function getNextPage(KvkPaginatorInterface $kvkPaginator): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getUrl($kvkPaginator->getNextUrl()));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    public function getPreviousPage(KvkPaginatorInterface $kvkPaginator): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getUrl($kvkPaginator->getPreviousUrl()));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    private function decodeJsonToArray(string $json): array
    {
        return json_decode($json, true)['data'];
    }
}
