<?php

namespace Werkspot\KvkApi\Client\Factory;

use Werkspot\KvkApi\Client\KvkPaginatorInterface;

interface KvkPaginatorFactoryInterface
{
    public function fromProfileData(array $data): KvkPaginatorInterface;
}
