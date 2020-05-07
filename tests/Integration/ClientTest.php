<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Integration;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Profile\Company;
use Werkspot\KvkApi\Http\Endpoint\Testing;
use Werkspot\KvkApi\Http\Search\ProfileQuery;
use Werkspot\KvkApi\KvkClientFactory;

/**
 * @large
 *
 * @internal
 */
final class ClientTest extends TestCase
{
    /**
     * @test
     * @dataProvider getKvkNumbers
     */
    public function get_profile(string $kvkNumber): void
    {
        $client = KvkClientFactory::create('', new Testing());

        $profileQuery = new ProfileQuery();
        $profileQuery->setKvkNumber($kvkNumber);

        $profileResponse = $client->getProfile($profileQuery);

        foreach ($profileResponse->getItems() as $company) {
            self::assertInstanceOf(Company::class, $company);
            self::assertEquals($kvkNumber, $company->getKvkNumber());
        }
    }

    /**
     * @test
     * @dataProvider getNonExistingKvkNumbers
     * @expectedException \Werkspot\KvkApi\Http\Adapter\Guzzle\Exception\NotFoundException
     */
    public function get_profile_should_throw_exception(string $kvkNumber): void
    {
        $client = KvkClientFactory::create('', new Testing());

        $profileQuery = new ProfileQuery();
        $profileQuery->setKvkNumber($kvkNumber);

        $client->getProfile($profileQuery);
    }

    public function getKvkNumbers(): array
    {
        return [
            'Eenmanszaak' => [69599084],
            'Stichting' => [69599068],
            'Stichting 2' => [90000102],
            'Onderlinge Waarborg Maatschappij' => [90001966],
            'NV' => [68727720],
            'NV 2' => [90004760],
            'VoF' => [69599076],
            'VoF 2' => [90005368],
            'Vereniging van Eigenaars' => [90000749],
            'Maatschap' => [90001745],
            'BV' => [68750110],
            'BV 2' => [90001354],
            'Coöperatie' => [90002636],
            'Commanditaire Vennootschap' => [90003942],
            'Kerkgenootschap' => [90001532],
            'Overige Privaatrechtelijke Rechtspersoon' => [90002148],
        ];
    }

    public function getNonExistingKvkNumbers(): array
    {
        return [
            'Eenmanszaak 2' => [90004841],
            'Vereniging' => [90003179],
        ];
    }
}
