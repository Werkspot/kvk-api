<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Profile\Company;

final class TradeNames
{
    private $businessName;

    private $shortBusinessName;

    private $currentTradeNames;

    private $currentStatutoryNames;

    public function __construct(
        ?string $businessName,
        ?string $shortBusinessName,
        ?array $currentTradeNames,
        ?array $currentStatutoryNames
    ) {
        $this->businessName = $businessName;
        $this->shortBusinessName = $shortBusinessName;
        $this->currentTradeNames = $currentTradeNames;
        $this->currentStatutoryNames = $currentStatutoryNames;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function getShortBusinessName(): ?string
    {
        return $this->shortBusinessName;
    }

    public function getCurrentTradeNames()
    {
        return $this->currentTradeNames;
    }

    public function getCurrentStatutoryNames()
    {
        return $this->currentStatutoryNames;
    }
}
