<?php

namespace Werkspot\KvkApi\Http;

use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Client\Search\QueryInterface;

interface ClientInterface
{
    public function getEndpoint(string $endpoint, QueryInterface $searchQuery): ResponseInterface;
    public function getUrl(string $url): ResponseInterface;
    public function getJson(ResponseInterface $response): string;
}
