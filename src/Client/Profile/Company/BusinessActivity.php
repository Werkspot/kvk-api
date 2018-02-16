<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Profile\Company;

final class BusinessActivity
{
    private $sbiCode;
    private $sbiCodeDescription;
    private $mainSbi;

    public function __construct(int $sbiCode, string $sbiCodeDescription, bool $mainSbi)
    {
        $this->sbiCode = $sbiCode;
        $this->sbiCodeDescription = $sbiCodeDescription;
        $this->mainSbi = $mainSbi;
    }

    public function getSbiCode(): int
    {
        return $this->sbiCode;
    }

    public function getSbiCodeDescription(): string
    {
        return $this->sbiCodeDescription;
    }

    public function isMainSbi(): bool
    {
        return $this->mainSbi;
    }
}
