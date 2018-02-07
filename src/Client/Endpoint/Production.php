<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Endpoint;

use Exception;
use Werkspot\KvkApi\Client\Endpoint\Exception\EndpointCouldNotBeMappedException;

final class Production implements MapperInterface
{
    public const BASE_URL = 'https://api.kvk.nl';
    private const SEARCH_Endpoint = '/api/v2/search/companies';
    private const PROFILE_Endpoint = '/api/v2/profile/companies';

    private $map = [
        MapperInterface::SEARCH => self::BASE_URL . self::SEARCH_Endpoint,
        MapperInterface::PROFILE => self::BASE_URL . self::PROFILE_Endpoint,
    ];

    public function map(string $key): string
    {
        try {
            return $this->map[$key];
        } catch (Exception $exception) {
            throw new EndpointCouldNotBeMappedException(sprintf('key \'%s\' could not be mapped to an URL', $key));
        }
    }
}
