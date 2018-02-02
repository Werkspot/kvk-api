<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Builder;

use DateTime;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Api\Profile\Company;
use Werkspot\KvkApi\Api\Profile\Company\TradeNames;
use Werkspot\KvkApi\Client\Builder\Profile\CompanyBuilderInterface;
use Werkspot\KvkApi\Client\Builder\ProfileResponseBuilder;

/**
 * @small
 */
final class ProfileResponseBuilderTest extends TestCase
{
    /**
     * @test
     * @dataProvider getResponseData
     */
    public function fromData(array $data): void
    {
        $companyBuilder = $this->getCompanyBuilder();
        foreach ($data['items'] as $company) {
            $companyBuilder->shouldReceive('fromArray')->with($company)->once()->andreturn($this->getCompany());
        }

        $builder = new ProfileResponseBuilder($companyBuilder);
        $profileResponse = $builder->fromData($data);

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
                        ["Company1"],
                        ["Company2"],
                    ]
                ],
            ]
        ];
    }

    /**
     * @return MockInterface|CompanyBuilderInterface
     */
    private function getCompanyBuilder()
    {
        return Mockery::mock(CompanyBuilderInterface::class);
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
