<?php

namespace Werkspot\KvkApi\Client;

interface KvkPaginatorInterface
{
    public function getNextUrl(): ?string;

    public function getPreviousUrl(): ?string;
}
