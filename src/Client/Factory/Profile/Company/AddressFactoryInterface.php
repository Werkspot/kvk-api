<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Factory\Profile\Company;

use Werkspot\KvkApi\Client\Profile\Company\Address;

interface AddressFactoryInterface
{
    /**
     * @return Address[]
     */
    public function fromArray(array $data): array;
}
