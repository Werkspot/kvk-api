<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Builder\Profile\Company;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Api\Profile\Company\Address\GpsCoordinates;
use Werkspot\KvkApi\Api\Profile\Company\Address\RijksDriehoek;
use Werkspot\KvkApi\Client\Builder\Profile\Company\AddressBuilder;

/**
 * @small
 */
final class AddressBuilderTest extends TestCase
{
    /**
     * @test
     * @dataProvider getAddressData
     */
    public function fromArray(array $data): void
    {
        $builder = new AddressBuilder();

        $output = $builder->fromArray($data);
        foreach ($output as $index => $address) {
            self::assertEquals($data[$index]['type'], $address->getType());
            self::assertEquals($data[$index]['bagId'], $address->getBagId());
            self::assertEquals($data[$index]['street'], $address->getStreet());
            self::assertEquals($data[$index]['houseNumber'], $address->getHouseNumber());
            self::assertEquals($data[$index]['houseNumberAddition'], $address->getHouseNumberAddition());
            self::assertEquals($data[$index]['postalCode'], $address->getPostalCode());
            self::assertEquals($data[$index]['city'], $address->getCity());
            self::assertEquals($data[$index]['country'], $address->getCountry());
            self::assertGpsCoordinates($data[$index], $address->getGpsCoordinates());
            self::assertRijksdriehoek($data[$index], $address->getRijksDriehoek());
        }
    }

    public function getAddressData(): array
    {
        return [
            [
                [
                    [
                        "type" => "vestigingsadres",
                        "bagId" => "",
                        "street" => "Geneinde",
                        "houseNumber" => "73",
                        "houseNumberAddition" => "",
                        "postalCode" => "6223GT",
                        "city" => "Maastricht",
                        "country" => "Nederland",
                        "gpsLatitude" => 0,
                        "gpsLongitude" => 0,
                        "rijksdriehoekX" => 0,
                        "rijksdriehoekY" => 0,
                        "rijksdriehoekZ" => 0
                    ],

                    [
                        "type" => "correspondentieadres",
                        "bagId" => "0632010000010090",
                        "street" => "Watermolenlaan",
                        "houseNumber" => "1",
                        "houseNumberAddition" => "",
                        "postalCode" => "3447GT",
                        "city" => "Woerden",
                        "country" => "Nederland",
                        "gpsLatitude" => 52.08151653230184,
                        "gpsLongitude" => 4.890048011859921,
                        "rijksdriehoekX" => 120921.45,
                        "rijksdriehoekY" => 454921.47,
                        "rijksdriehoekZ" => 0
                    ]
                ]
            ]
        ];
    }

    private static function assertGpsCoordinates($data, ?GpsCoordinates $gpsCoordinates)
    {
        if (array_key_exists('gpsLatitude', $data) && array_key_exists('gpsLongitude', $data)) {
            self::assertSame((float) $data['gpsLatitude'], $gpsCoordinates->getLatitude());
            self::assertSame((float) $data['gpsLongitude'], $gpsCoordinates->getLongitude());
        } else {
            self::assertNull($gpsCoordinates);
        }
    }

    private static function assertRijksdriehoek($data, ?RijksDriehoek $rijksDriehoek)
    {
        if (
            array_key_exists('rijksdriehoekX', $data) &&
            array_key_exists('rijksdriehoekY', $data) &&
            array_key_exists('rijksdriehoekZ', $data)
        ) {
            self::assertSame((float) $data['rijksdriehoekX'], $rijksDriehoek->getX());
            self::assertSame((float) $data['rijksdriehoekY'], $rijksDriehoek->getY());
            self::assertSame((float) $data['rijksdriehoekZ'], $rijksDriehoek->getZ());
        } else {
            self::assertNull($rijksDriehoek);
        }
    }
}
