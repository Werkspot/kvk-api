<?php

namespace Werkspot\KvkApi\Client\Builder\Profile\Company;

use Werkspot\KvkApi\Api\Profile\Company\BusinessActivity;

interface BusinessActivityBuilderInterface
{
    /**
     * @return BusinessActivity[]
     */
    public function fromArray(array $data): array;
}
