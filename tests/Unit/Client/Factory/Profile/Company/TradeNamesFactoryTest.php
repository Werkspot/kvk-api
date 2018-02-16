<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Factory\Profile\Company;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Factory\Profile\Company\TradeNamesFactory;

/**
 * @small
 */
final class TradeNamesFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider getArrayData
     */
    public function fromArray(array $data): void
    {
        $factory = new TradeNamesFactory();
        $output = $factory->fromArray($data);

        self::assertIfExists('businessName', $data, $output->getBusinessName());
        self::assertIfExists('shortBusinessName', $data, $output->getShortBusinessName());
        self::assertCurrentTradeNames($data, $output->getCurrentTradeNames());
        self::assertCurrentStatutoryNames($data, $output->getCurrentStatutoryNames());
    }

    public function getArrayData(): array
    {
        return [
            [
                [
                    'businessName' => 'Test EMZ Nevenvestiging Govert',
                    'currentTradeNames' => [
                        'Test EMZ Nevenvestiging Govert',
                        'Tweede handelsnaam Vestiging2',
                        'Derde handelsnaam Vestiging2',
                        'Vierde handelsnaam Vestiging2'
                    ]
                ]
            ],
            [
                [
                    'shortBusinessName' => 'Test NV Katrien',
                    'currentStatutoryNames' => [ 'Test NV Katrien']
                ]
            ]
        ];
    }

    private static function assertIfExists($key, $data, $result)
    {
        if (array_key_exists($key, $data)) {
            self::assertSame($data[$key], $result);
        }
    }

    private static function assertInArray($data, $currentTradeName): void
    {
        self::assertTrue(in_array($currentTradeName, $data));
    }

    private static function assertCurrentTradeNames(array $data, ?array $currentTradeNames)
    {
        foreach ((array) $currentTradeNames as $currentTradeName) {
            self::assertInArray($data['currentTradeNames'], $currentTradeName);
        }
    }

    private static function assertCurrentStatutoryNames(array $data, ?array $currentStatutoryNames)
    {
        foreach ((array) $currentStatutoryNames as $currentStatutoryName) {
            self::assertInArray($data['currentStatutoryNames'], $currentStatutoryName);
        }
    }
}
