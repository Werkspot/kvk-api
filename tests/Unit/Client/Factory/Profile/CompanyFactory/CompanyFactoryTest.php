<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Tests\Unit\Client\Factory\Profile\CompanyFactory;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Factory\Profile\Company\AddressFactoryInterface;
use Werkspot\KvkApi\Client\Factory\Profile\Company\BusinessActivityFactoryInterface;
use Werkspot\KvkApi\Client\Factory\Profile\Company\TradeNamesFactoryInterface;
use Werkspot\KvkApi\Client\Factory\Profile\CompanyFactory;
use Werkspot\KvkApi\Client\Profile\Company;
use Werkspot\KvkApi\Client\Profile\Company\TradeNames;
use Werkspot\KvkApi\Tests\Unit\MockeryAssertionTrait;

/**
 * @small
 */
abstract class CompanyFactoryTest extends TestCase
{
    use MockeryAssertionTrait;

    /**
     * @test
     * @dataProvider getCompanyData
     */
    public function from_array(array $data): void
    {
        $tradeNamesFactory = $this->getTradeNamesFactory();
        $tradeNamesFactory->shouldReceive('fromArray')
            ->with($data['tradeNames'])
            ->once()
            ->andReturn(new TradeNames(null, null, null, null));
        $businessActivityFactory = $this->getBusinessActivityFactory();
        $businessActivityFactory->shouldReceive('fromArray')
            ->with($data['businessActivities'])
            ->once()
            ->andReturn($data['businessActivities']);
        $addressFactory = $this->getAddressFactory();
        $addressFactory->shouldReceive('fromArray')->with($data['addresses'])->once()->andReturn($data['addresses']);

        $factory = new CompanyFactory($tradeNamesFactory, $businessActivityFactory, $addressFactory);

        $company = $factory->fromArray($data);

        $this->assertData($data, $company);
    }

    abstract public function assertData(array $data, Company $company);

    abstract public function getCompanyData(): array;

    /**
     * @return MockInterface|TradeNamesFactoryInterface
     */
    private function getTradeNamesFactory()
    {
        return Mockery::mock(TradeNamesFactoryInterface::class);
    }

    /**
     * @return MockInterface|BusinessActivityFactoryInterface
     */
    private function getBusinessActivityFactory()
    {
        return Mockery::mock(BusinessActivityFactoryInterface::class);
    }

    /**
     * @return MockInterface|AddressFactoryInterface
     */
    private function getAddressFactory()
    {
        return Mockery::mock(AddressFactoryInterface::class);
    }
}
