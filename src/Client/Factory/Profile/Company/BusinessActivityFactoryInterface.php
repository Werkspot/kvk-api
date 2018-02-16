<?php

namespace Werkspot\KvkApi\Client\Factory\Profile\Company;

use Werkspot\KvkApi\Client\Profile\Company\BusinessActivity;

interface BusinessActivityFactoryInterface
{
    /**
     * @return BusinessActivity[]
     */
    public function fromArray(array $data): array;
}
