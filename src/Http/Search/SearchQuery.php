<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Http\Search;

final class SearchQuery implements QueryInterface
{
    /**
     * @info KvK number, identifying number for a registration in the Netherlands Business Register. Consists of 8 digits
     * @var string
     */
    private $kvkNumber;

    /**
     * @info Branch number (Vestigingsnummer), identifying number of a branch. Consists of 12 digits
     * @var string
     */
    private $branchNumber;

    /**
     * @info RSIN is an identification number for legal entities and partnerships. Consist of only digits
     * @var int
     */
    private $rsin;

    /**
     * @info Street of an address
     * @var string
     */
    private $street;

    /**
     * @info House number of an address
     * @var string
     */
    private $houseNumber;

    /**
     * @info Postal code or ZIP code, example 1000AA
     * @var string
     */
    private $postalCode;

    /**
     * @info City or Town name
     * @var string
     */
    private $city;

    /**
     * @info Indication  to include searching through inactive dossiers/deregistered companies.
     * @note History of inactive companies is after 1 January 2012
     * @var bool
     */
    private $includeInactiveRegistrations;

    /**
     * @info restrictToMainBranch Search is restricted to main branches.
     * @var bool
     */
    private $restrictToMainBranch;

    /**
     * @info Defines the search collection for the query
     * @var string
     */
    private $site;

    /**
     * @info User can optionally add a context to identify his result later on
     * @var string
     */
    private $context;

    /**
     * @info Free format text search for in the compiled search description.
     * @var string
     */
    private $q;

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function getKvkNumber(): string
    {
        return $this->kvkNumber;
    }

    public function setKvkNumber(string $kvkNumber): void
    {
        $this->kvkNumber = $kvkNumber;
    }

    public function getBranchNumber(): string
    {
        return $this->branchNumber;
    }

    public function setBranchNumber(string $branchNumber): void
    {
        $this->branchNumber = $branchNumber;
    }

    public function getRsin(): int
    {
        return $this->rsin;
    }

    public function setRsin(int $rsin): void
    {
        $this->rsin = $rsin;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function isIncludeInactiveRegistrations(): bool
    {
        return $this->includeInactiveRegistrations;
    }

    public function setIncludeInactiveRegistrations(bool $includeInactiveRegistrations): void
    {
        $this->includeInactiveRegistrations = $includeInactiveRegistrations;
    }

    public function isRestrictToMainBranch(): bool
    {
        return $this->restrictToMainBranch;
    }

    public function setRestrictToMainBranch(bool $restrictToMainBranch): void
    {
        $this->restrictToMainBranch = $restrictToMainBranch;
    }

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    public function getQ(): string
    {
        return $this->q;
    }

    public function setQ(string $q): void
    {
        $this->q = $q;
    }

    public function get(): array
    {
        return get_object_vars($this);
    }
}
