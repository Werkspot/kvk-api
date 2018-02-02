<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder\Profile;

use DateTime;
use Werkspot\KvkApi\Api\Profile\Company;
use Werkspot\KvkApi\Client\Builder\AbstractBuilder;
use Werkspot\KvkApi\Client\Builder\Profile\Company\AddressBuilderInterface;
use Werkspot\KvkApi\Client\Builder\Profile\Company\BusinessActivityBuilderInterface;
use Werkspot\KvkApi\Client\Builder\Profile\Company\TradeNamesBuilderInterface;

final class CompanyBuilder extends AbstractBuilder implements CompanyBuilderInterface
{
    /**
     * @var AddressBuilderInterface
     */
    private $addressBuilder;

    /**
     * @var BusinessActivityBuilderInterface
     */
    private $businessActivityBuilder;

    /**
     * @var TradeNamesBuilderInterface
     */
    private $tradeNamesBuilder;

    public function __construct(
        TradeNamesBuilderInterface $tradeNamesBuilder,
        BusinessActivityBuilderInterface $businessActivityBuilder,
        AddressBuilderInterface $addressBuilder
    ) {
        $this->tradeNamesBuilder = $tradeNamesBuilder;
        $this->businessActivityBuilder = $businessActivityBuilder;
        $this->addressBuilder = $addressBuilder;
    }

    public function fromArray(array $data): Company
    {
        return new Company(
            $this->extractIntegerOrNull('kvkNumber', $data),
            $this->extractStringOrNull('branchNumber', $data),
            $this->extractIntegerOrNull('rsin', $data),
            $this->tradeNamesBuilder->fromArray($data['tradeNames']),
            $this->extractStringOrNull('legalForm', $data),
            $this->extractBusinessActivities($data),
            $this->extractBoolean('hasEntryInBusinessRegister', $data),
            $this->extractBoolean('hasCommercialActivities', $data),
            $this->extractBoolean('hasNonMailingIndication', $data),
            $this->extractBoolean('isLegalPerson', $data),
            $this->extractBoolean('isBranch', $data),
            $this->extractBoolean('isMainBranch', $data),
            $this->extractIntegerOrNull('employees', $data),
            new DateTime($data['foundationDate']),
            new DateTime($data['registrationDate']),
            $this->extractAddresses($data)
        );
    }

    private function extractBusinessActivities($data): ?array
    {
        if (array_key_exists('businessActivities', $data)) {
            return $this->businessActivityBuilder->fromArray($data['businessActivities']);
        }

        return null;
    }

    private function extractAddresses($data): ?array
    {
        if (array_key_exists('addresses', $data)) {
            return $this->addressBuilder->fromArray($data['addresses']);
        }

        return null;
    }
}
