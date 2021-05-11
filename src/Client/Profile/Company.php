<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Profile;

use DateTime;
use Werkspot\KvkApi\Client\Profile\Company\Address;
use Werkspot\KvkApi\Client\Profile\Company\BusinessActivity;
use Werkspot\KvkApi\Client\Profile\Company\TradeNames;

final class Company
{
    private $kvkNumber;

    private $branchNumber;

    private $rsin;

    private $tradeNames;

    private $legalForm;

    private $businessActivities;

    private $entryInBusinessRegister;

    private $commercialActivities;

    private $nonMailingIndication;

    private $legalPerson;

    private $branch;

    private $mainBranch;

    private $employees;

    private $foundationDate;

    private $registrationDate;

    private $addresses;

    public function __construct(
        string $kvkNumber,
        ?string $branchNumber = null,
        ?int $rsin = null,
        TradeNames $tradeNames,
        ?string $legalForm,
        ?array $businessActivities = null,
        bool $entryInBusinessRegister,
        bool $commercialActivities,
        bool $nonMailingIndication,
        bool $legalPerson,
        bool $branch,
        bool $mainBranch,
        ?int $employees,
        DateTime $foundationDate,
        DateTime $registrationDate,
        ?array $addresses = null
    ) {
        $this->kvkNumber = $kvkNumber;
        $this->branchNumber = $branchNumber;
        $this->rsin = $rsin;
        $this->tradeNames = $tradeNames;
        $this->legalForm = $legalForm;
        $this->businessActivities = $businessActivities;
        $this->entryInBusinessRegister = $entryInBusinessRegister;
        $this->commercialActivities = $commercialActivities;
        $this->nonMailingIndication = $nonMailingIndication;
        $this->legalPerson = $legalPerson;
        $this->branch = $branch;
        $this->mainBranch = $mainBranch;
        $this->employees = $employees;
        $this->foundationDate = $foundationDate;
        $this->registrationDate = $registrationDate;
        $this->addresses = $addresses;
    }

    public function getKvkNumber(): string
    {
        return $this->kvkNumber;
    }

    public function getBranchNumber(): ?string
    {
        return $this->branchNumber;
    }

    public function getRsin(): ?int
    {
        return $this->rsin;
    }

    public function getTradeNames(): TradeNames
    {
        return $this->tradeNames;
    }

    public function getLegalForm(): string
    {
        return $this->legalForm;
    }

    /**
     * @return BusinessActivity[]
     */
    public function getBusinessActivities(): ?array
    {
        return $this->businessActivities;
    }

    public function hasEntryInBusinessRegister(): bool
    {
        return $this->entryInBusinessRegister;
    }

    public function hasCommercialActivities(): bool
    {
        return $this->commercialActivities;
    }

    public function hasNonMailingIndication(): bool
    {
        return $this->nonMailingIndication;
    }

    public function isLegalPerson(): bool
    {
        return $this->legalPerson;
    }

    public function isBranch(): bool
    {
        return $this->branch;
    }

    public function isMainBranch(): bool
    {
        return $this->mainBranch;
    }

    public function getEmployees(): int
    {
        return $this->employees;
    }

    public function getFoundationDate(): DateTime
    {
        return $this->foundationDate;
    }

    public function getRegistrationDate(): DateTime
    {
        return $this->registrationDate;
    }

    /**
     * @return Address[]
     */
    public function getAddresses(): ?array
    {
        return $this->addresses;
    }
}
