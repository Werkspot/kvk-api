<?php

namespace Werkspot\KvkApi\Client\Authentication;

interface AuthenticationInterface
{
    public function getHeader(): string;
}
