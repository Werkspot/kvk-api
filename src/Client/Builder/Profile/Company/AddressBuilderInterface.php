<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder\Profile\Company;

use Werkspot\KvkApi\Api\Profile\Company\Address;

interface AddressBuilderInterface
{
    /**
     * @return Address[]
     */
    public function fromArray(array $data): array;
}
