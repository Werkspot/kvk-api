<?php

declare(strict_types=1);

namespace Werkspot\KvkApi;

use Werkspot\KvkApi\Client\KvkPaginatorInterface;
use Werkspot\KvkApi\Http\Search\QueryInterface;

interface KvkClientInterface
{
    public function getProfile(QueryInterface $profileQuery): KvkPaginatorInterface;
}

