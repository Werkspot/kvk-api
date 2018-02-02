<?php

namespace Werkspot\KvkApi\Client\Adapter;

use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Client\Search\QueryInterface;

interface AdapterInterface
{
    public function getEndPoint(string $endPoint, QueryInterface $searchQuery): ResponseInterface;
    public function getUrl(string $url): ResponseInterface;
    public function getJson(ResponseInterface $response): string;
}
