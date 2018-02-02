<?php

namespace Werkspot\KvkApi\Client\Builder;

use Werkspot\KvkApi\Api\ProfileResponse;

interface ProfileResponseBuilderInterface
{
    public function fromData(array $data): ProfileResponse;
}
