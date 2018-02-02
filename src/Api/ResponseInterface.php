<?php

namespace Werkspot\KvkApi\Api;

interface ResponseInterface
{
    public function getNextUrl(): ?string;
    public function getPreviousUrl(): ?string;
}
