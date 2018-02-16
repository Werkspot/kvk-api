<?php

namespace Werkspot\KvkApi\Client\Factory\Profile;

use Werkspot\KvkApi\Client\Profile\Company;

interface CompanyFactoryInterface
{
    public function fromArray(array $data): Company;
}
