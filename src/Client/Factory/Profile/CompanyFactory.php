<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Factory\Profile;

use DateTime;
use Werkspot\KvkApi\Client\Factory\AbstractFactory;
use Werkspot\KvkApi\Client\Factory\Profile\Company\AddressFactoryInterface;
use Werkspot\KvkApi\Client\Factory\Profile\Company\BusinessActivityFactoryInterface;
use Werkspot\KvkApi\Client\Factory\Profile\Company\TradeNamesFactoryInterface;
use Werkspot\KvkApi\Client\Profile\Company;

final class CompanyFactory extends AbstractFactory implements CompanyFactoryInterface
{
    /**
     * @var AddressFactoryInterface
     */
    private $addressFactory;

    /**
     * @var BusinessActivityFactoryInterface
     */
    private $businessActivityFactory;

    /**
     * @var TradeNamesFactoryInterface
     */
    private $tradeNamesFactory;

    public function __construct(
        TradeNamesFactoryInterface $tradeNamesFactory,
        BusinessActivityFactoryInterface $businessActivityFactory,
        AddressFactoryInterface $addressFactory
    )
    {
        $this->tradeNamesFactory = $tradeNamesFactory;
        $this->businessActivityFactory = $businessActivityFactory;
        $this->addressFactory = $addressFactory;
    }

    public function fromArray(array $data): Company
    {
        return new Company(
            $this->extractIntegerOrNull('kvkNumber', $data),
            $this->extractStringOrNull('branchNumber', $data),
            $this->extractIntegerOrNull('rsin', $data),
            $this->tradeNamesFactory->fromArray($data['tradeNames']),
            $this->extractStringOrNull('legalForm', $data),
            $this->extractBusinessActivities($data),
            $this->extractBoolean('hasEntryInBusinessRegister', $data),
            $this->extractBoolean('hasCommercialActivities', $data),
            $this->extractBoolean('hasNonMailingIndication', $data),
            $this->extractBoolean('isLegalPerson', $data),
            $this->extractBoolean('isBranch', $data),
            $this->extractBoolean('isMainBranch', $data),
            $this->extractIntegerOrNull('employees', $data),
            new DateTime($data['foundationDate'] ?? 'NOW'),
            new DateTime( $data['registrationDate'] ?? $data['foundationDate'] ?? 'NOW'),
            $this->extractAddresses($data)
        );
    }

    private function extractBusinessActivities($data): ?array
    {
        if (array_key_exists('businessActivities', $data)) {
            return $this->businessActivityFactory->fromArray($data['businessActivities']);
        }

        return null;
    }

    private function extractAddresses($data): ?array
    {
        if (array_key_exists('addresses', $data)) {
            return $this->addressFactory->fromArray($data['addresses']);
        }

        return null;
    }
}
