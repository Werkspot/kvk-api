<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Http\Adapter\Guzzle;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Http\Adapter\Guzzle\Exception\Handler;
use Werkspot\KvkApi\Http\ClientInterface;
use Werkspot\KvkApi\Http\Endpoint\MapperInterface;
use Werkspot\KvkApi\Http\Search\QueryInterface;

final class Client implements ClientInterface
{
    /**
     * @var GuzzleClientInterface
     */
    private $guzzleClient;

    /**
     * @var MapperInterface
     */
    private $endpointMapper;

    public function __construct(
        GuzzleClientInterface $guzzleClient,
        MapperInterface $urlMapper
    ) {
        $this->guzzleClient = $guzzleClient;
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
        try {
            return $this->guzzleClient->get($url, $options);
        } catch (RequestException $exception) {
            Handler::handleRequestException($exception);
        }
    }
}
