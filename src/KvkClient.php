<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use function json_encode;
use Werkspot\KvkApi\Client\Factory\KvkPaginatorFactoryInterface;
use Werkspot\KvkApi\Client\KvkPaginator;
use Werkspot\KvkApi\Client\KvkPaginatorInterface;
use Werkspot\KvkApi\Exception\KvkApiException;
use Werkspot\KvkApi\Http\ClientInterface;
use Werkspot\KvkApi\Http\Endpoint\MapperInterface;
use Werkspot\KvkApi\Http\Search\QueryInterface;

final class KvkClient implements KvkClientInterface, KvkPaginatorAwareInterface
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

    public function getProfile(QueryInterface $profileQuery): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::PROFILE, $profileQuery));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    /**
     * Execute search query
     * @param QueryInterface $profileQuery
     * @return KvkPaginatorInterface
     * @throws KvkApiException
     * @author Patrick Development <info@patrickdevelopment.nl>
     */
    public function getSearch(QueryInterface $profileQuery): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::SEARCH, $profileQuery));
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
        $jsonPayload = json_decode($json, true);

        if (!isset($jsonPayload['data']) && !isset($jsonPayload['error'])) {
            throw new KvkApiException(
                "Unknown payload: \n"
                . $json
            );
        }

        if (!isset($jsonPayload['data'])) {
            throw new KvkApiException(
                $jsonPayload['error']['message'] . ': ' . $jsonPayload['error']['reason'],
                $jsonPayload['error']['code']
            );
        }

        return $jsonPayload['data'];
    }
}
