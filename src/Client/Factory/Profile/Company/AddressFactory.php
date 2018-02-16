<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Factory\Profile\Company;

use Werkspot\KvkApi\Client\Factory\AbstractFactory;
use Werkspot\KvkApi\Client\Profile\Company\Address;
use Werkspot\KvkApi\Client\Profile\Company\Address\GpsCoordinates;
use Werkspot\KvkApi\Client\Profile\Company\Address\RijksDriehoek;

final class AddressFactory extends AbstractFactory implements AddressFactoryInterface
{
    /**
     * @return Address[]
     */
    public function fromArray(array $data): array
    {
        $addresses = [];
        foreach ($data as $address) {
            $addresses[] = $this->buildFromArray($address);
        }

        return $addresses;
    }

    private function buildFromArray($data): Address
    {
        return new Address(
            $this->extractStringOrNull('type', $data),
            $this->extractStringOrNull('bagId', $data),
            $this->extractStringOrNull('street', $data),
            $this->extractStringOrNull('houseNumber', $data),
            $this->extractStringOrNull('houseNumberAddition', $data),
            $this->extractStringOrNull('postalCode', $data),
            $this->extractStringOrNull('city', $data),
            $this->extractStringOrNull('country', $data),
            $this->extractGpsCoordinates($data),
            $this->extractRijksDriehoek($data)
        );
    }

    private function extractGpsCoordinates(array $data): ?GpsCoordinates
    {
        if (array_key_exists('gpsLatitude', $data) && array_key_exists('gpsLongitude', $data)) {
            return new GpsCoordinates(
                $this->extractFloatOrNull('gpsLatitude', $data),
                $this->extractFloatOrNull('gpsLongitude', $data)
            );
        }

        return null;
    }

    private function extractRijksDriehoek(array $data): ?RijksDriehoek
    {
        if (
            array_key_exists('rijksdriehoekX', $data) &&
            array_key_exists('rijksdriehoekY', $data) &&
            array_key_exists('rijksdriehoekZ', $data)
        ) {
            return new RijksDriehoek(
                $this->extractFloatOrNull('rijksdriehoekX', $data),
                $this->extractFloatOrNull('rijksdriehoekY', $data),
                $this->extractFloatOrNull('rijksdriehoekZ', $data)
            );
        }

        return null;
    }
}
