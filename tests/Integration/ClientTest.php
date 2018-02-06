<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Tests\Integration;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Api\Profile\Company;
use Werkspot\KvkApi\Client\Adapter\Guzzle;
use Werkspot\KvkApi\Client\Adapter\Guzzle\Exception\NotFoundException;
use Werkspot\KvkApi\Client\Authentication;
use Werkspot\KvkApi\Client\Endpoint;
use Werkspot\KvkApi\Client\Search\ProfileQuery;
use Werkspot\KvkApi\ClientFactory;

/**
 * @large
 */
final class ClientTest extends TestCase
{
    private const USERNAME = 'testourapis';
    private const PASSWORD = 'testourapis';

    /**
     * @test
     * @dataProvider getKvkNumbers
     */
    public function getProfile(int $kvkNumber): void
    {
        $client = ClientFactory::getClient($this->getAdapter());

        $profileQuery = new ProfileQuery();
        $profileQuery->setKvkNumber($kvkNumber);

        try {
            $profileResponse = $client->getProfile($profileQuery);
        } catch (NotFoundException $e) {
            self::assertTrue(true);

            return;
        }

        foreach ($profileResponse->getCompanies() as $company) {
            self::assertInstanceOf(Company::class, $company);
            self::assertEquals($kvkNumber, $company->getKvkNumber());
        }
    }

    public function getKvkNumbers(): array
    {
        return [
            'Eenmanszaak' => [69599084],
            'Eenmanszaak 2' => [90004841],
            'Stichting' => [69599068],
            'Stichting 2' => [90000102],
            'Onderlinge Waarborg Maatschappij' => [90001966],
            'Vereniging' => [90003179],
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

    /**
     * @return Guzzle
     */
    private function getAdapter(): Guzzle
    {
        return new Guzzle(
            new Client(),
            new Authentication\HttpBasic(self::USERNAME, self::PASSWORD),
            new Endpoint\Testing()
        );
    }
}
