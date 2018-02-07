<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Adapter;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Client\Adapter\Guzzle\Exception\Handler;
use Werkspot\KvkApi\Client\Authentication\AuthenticationInterface;
use Werkspot\KvkApi\Client\Endpoint\MapperInterface;
use Werkspot\KvkApi\Client\Search\QueryInterface;

final class Guzzle implements AdapterInterface
{
    /**
     * @var GuzzleClientInterface
     */
    private $guzzleClient;

    /**
     * @var AuthenticationInterface
     */
    private $authentication;

    /**
     * @var MapperInterface
     */
    private $endpointMapper;

    public function __construct(
        GuzzleClientInterface $guzzleClient,
        AuthenticationInterface $authentication,
        MapperInterface $urlMapper
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->authentication = $authentication;
        $this->endpointMapper = $urlMapper;
    }

    public function getEndpoint(string $endpoint, QueryInterface $searchQuery): ResponseInterface
    {
        return $this->get(
            $this->endpointMapper->map($endpoint),
            ['query' => $searchQuery->get()]
        );
    }

    public function getUrl(string $url): ResponseInterface
    {
        return $this->get($url);
    }

    public function getJson(ResponseInterface $response): string
    {
        return $response->getBody()->getContents();
    }

    private function get(string $url, ?array $options = [])
    {
        $options = array_merge(
            $options,
            ['headers' => [$this->authentication->getHeader()]]
         );

        try {
            return $this->guzzleClient->get($url, $options);
        } catch (RequestException $exception) {
            Handler::handleRequestException($exception);
        }
    }
}
