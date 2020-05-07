<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Unit\Client\Factory;

use DateTime;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Factory\KvkPaginatorFactory;
use Werkspot\KvkApi\Client\Factory\Profile\CompanyFactoryInterface;
use Werkspot\KvkApi\Client\Profile\Company;
use Werkspot\KvkApi\Client\Profile\Company\TradeNames;

/**
 * @small
 *
 * @internal
 */
final class KvkPaginatorFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider getResponseData
     */
    public function from_data(array $data): void
    {
        $companyFactory = $this->getCompanyFactory();
        foreach ($data['items'] as $company) {
            $companyFactory->shouldReceive('fromArray')->with($company)->once()->andreturn($this->getCompany());
        }

        $factory = new KvkPaginatorFactory($companyFactory);
        $profileResponse = $factory->fromProfileData($data);

        self::assertEquals($data['itemsPerPage'], $profileResponse->getItemsPerPage());
        self::assertEquals($data['startPage'], $profileResponse->getStartPage());
        self::assertEquals($data['totalItems'], $profileResponse->getTotalItems());
        self::assertEquals($data['nextLink'], $profileResponse->getNextUrl());
        self::assertEquals($data['previousLink'], $profileResponse->getPreviousUrl());
    }

    public function getResponseData(): array
    {
        return [
            [
                [
                    "itemsPerPage" => 1,
                    "startPage" => 2,
                    "totalItems" => 3,
                    "nextLink" => "nextURL",
                    "previousLink" => 'previousURL',
                    "items" => [
                        ["Item1"],
                        ["Item2"],
                    ]
                ],
            ]
        ];
    }

    /**
     * @return MockInterface|CompanyFactoryInterface
     */
    private function getCompanyFactory()
    {
        return Mockery::mock(CompanyFactoryInterface::class);
    }

    private function getCompany(): Company
    {
        return new Company(
            123,
            null,
            null,
            new TradeNames(null, null, null, null),
            'legalForm',
            null,
            true,
            true,
            true,
            true,
            true,
            true,
            1,
            new DateTime(),
            new DateTime(),
            null
        );
    }
}
