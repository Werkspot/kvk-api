<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Factory\Profile\CompanyFactory;

use Werkspot\KvkApi\Client\Profile\Company;
use Werkspot\KvkApi\Client\Profile\Company\TradeNames;
use Werkspot\KvkApi\Tests\Unit\Client\Factory\Profile\CompanyFactory\CompanyFactoryTest;

/**
 * @small
 *
 * @internal
 */
final class CompanyFactoryFlexibilityTest extends CompanyFactoryTest
{
    public function getCompanyData(): array
    {
        return [
            [
                [
                    'kvkNumber' => '69599084',
                    'branchNumber' => '000038509520',
                    'rsin' => '857587973',
                    'tradeNames' => ['tradeNames'],
                    'legalForm' => 'Eenmanszaak',
                    'businessActivities' => ['businessActivities'],
                    'hasEntryInBusinessRegister' => true,
                    'hasCommercialActivities' => true,
                    'hasNonMailingIndication' => true,
                    'isLegalPerson' => false,
                    'isBranch' => true,
                    'isMainBranch' => false,
                    'employees' => 5,
                    'foundationDate' => '20170108',
                    'addresses' => ['Address']
                ],
            ]
        ];
    }

    public function assertData(array $data, Company $company)
    {
        self::assertEquals($data['kvkNumber'], $company->getKvkNumber());
        self::assertEquals($data['branchNumber'], $company->getBranchNumber());
        self::assertEquals($data['rsin'], $company->getRsin());
        self::assertInstanceOf(TradeNames::class, $company->getTradeNames());
        self::assertEquals($data['legalForm'], $company->getLegalForm());
        self::assertEquals($data['businessActivities'], $company->getBusinessActivities());
        self::assertEquals($data['hasEntryInBusinessRegister'], $company->hasEntryInBusinessRegister());
        self::assertEquals($data['hasCommercialActivities'], $company->hasCommercialActivities());
        self::assertEquals($data['hasNonMailingIndication'], $company->hasNonMailingIndication());
        self::assertEquals($data['isLegalPerson'], $company->isLegalPerson());
        self::assertEquals($data['isBranch'], $company->isBranch());
        self::assertEquals($data['isMainBranch'], $company->isMainBranch());
        self::assertEquals($data['employees'], $company->getEmployees());
        self::assertEquals($data['foundationDate'], $company->getFoundationDate()->format('Ymd'));
        self::assertEquals($data['foundationDate'], $company->getRegistrationDate()->format('Ymd'));
        self::assertEquals($data['addresses'], $company->getAddresses());
    }
}
