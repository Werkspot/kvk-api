<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Authentication;

final class HttpBasic implements AuthenticationInterface
{
    private $username;

    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getHeader(): string
    {
        $hash = base64_encode(sprintf('%s:%s', $this->username, $this->password));

        return sprintf('Authorization:Basic %s', $hash);
    }
}
