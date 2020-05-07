<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Http\Search;

final class SearchQuery implements QueryInterface
{
    /**
     * KvK number, identifying number for a registration in the Netherlands Business Register. Consists of 8 digits
     *
     * @var string
     */
    private $kvkNumber;

    /**
     * Branch number (Vestigingsnummer), identifying number of a branch. Consists of 12 digits
     *
     * @var string
     */
    private $branchNumber;

    /**
     * RSIN is an identification number for legal entities and partnerships. Consist of only digits
     *
     * @var int
     */
    private $rsin;

    /**
     * Street of an address
     *
     * @var string
     */
    private $street;

    /**
     * House number of an address
     *
     * @var string
     */
    private $houseNumber;

    /**
     * Postal code or ZIP code, example 1000AA
     *
     * @var string
     */
    private $postalCode;

    /**
     * City or Town name
     *
     * @var string
     */
    private $city;

    /**
     * Indication  to include searching through inactive dossiers/deregistered companies.
     * @note History of inactive companies is after 1 January 2012
     *
     * @var bool
     */
    private $includeInactiveRegistrations;

    /**
     * restrictToMainBranch Search is restricted to main branches.
     *
     * @var bool
     */
    private $restrictToMainBranch;

    /**
     * Defines the search collection for the query
     *
     * @var string
     */
    private $site;

    /**
     * User can optionally add a context to identify his result later on
     *
     * @var string
     */
    private $context;

    /**
     * Free format text search for in the compiled search description.
     *
     * @var string
     */
    private $q;

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): SearchQuery
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): SearchQuery
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getKvkNumber(): string
    {
        return $this->kvkNumber;
    }

    public function setKvkNumber(string $kvkNumber): SearchQuery
    {
        $this->kvkNumber = $kvkNumber;

        return $this;
    }

    public function getBranchNumber(): string
    {
        return $this->branchNumber;
    }

    public function setBranchNumber(string $branchNumber): SearchQuery
    {
        $this->branchNumber = $branchNumber;

        return $this;
    }

    public function getRsin(): int
    {
        return $this->rsin;
    }

    public function setRsin(int $rsin): SearchQuery
    {
        $this->rsin = $rsin;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): SearchQuery
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): SearchQuery
    {
        $this->city = $city;

        return $this;
    }

    public function isIncludeInactiveRegistrations(): bool
    {
        return $this->includeInactiveRegistrations;
    }

    public function setIncludeInactiveRegistrations(bool $includeInactiveRegistrations): SearchQuery
    {
        $this->includeInactiveRegistrations = $includeInactiveRegistrations;

        return $this;
    }

    public function isRestrictToMainBranch(): bool
    {
        return $this->restrictToMainBranch;
    }

    public function setRestrictToMainBranch(bool $restrictToMainBranch): SearchQuery
    {
        $this->restrictToMainBranch = $restrictToMainBranch;

        return $this;
    }

    public function getSite(): string
    {
        return $this->site;
    }

    public function setSite(string $site): SearchQuery
    {
        $this->site = $site;

        return $this;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    public function setContext(string $context): SearchQuery
    {
        $this->context = $context;

        return $this;
    }

    public function getQ(): string
    {
        return $this->q;
    }

    public function setQ(string $q): SearchQuery
    {
        $this->q = $q;

        return $this;
    }

    public function get(): array
    {
        return get_object_vars($this);
    }
}
