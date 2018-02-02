<?php

namespace Werkspot\KvkApi\Client\Builder\Profile;

use Werkspot\KvkApi\Api\Profile\Company;

interface CompanyBuilderInterface
{
    public function fromArray(array $data): Company;
}
