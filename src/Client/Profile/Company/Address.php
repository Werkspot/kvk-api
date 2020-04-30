<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Profile\Company;

use Werkspot\KvkApi\Client\Profile\Company\Address\GpsCoordinates;
use Werkspot\KvkApi\Client\Profile\Company\Address\RijksDriehoek;

final class Address
{
    private $type;

    private $bagId;

    private $street;

    private $houseNumber;

    private $houseNumberAddition;

    private $postalCode;

    private $city;

    private $country;

    private $gpsCoordinates;

    private $rijksDriehoek;

    public function __construct(
        string $type,
        ?string $bagId,
        string $street,
        string $houseNumber,
        ?string $houseNumberAddition,
        string $postalCode,
        string $city,
        string $country,
        ?GpsCoordinates $gpsCoordinates = null,
        ?RijksDriehoek $rijksDriehoek =  null
    ) {
        $this->type = $type;
        $this->bagId = $bagId;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->houseNumberAddition = $houseNumberAddition;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
        $this->gpsCoordinates = $gpsCoordinates;
        $this->rijksDriehoek = $rijksDriehoek;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBagId(): string
    {
        return $this->bagId;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getHouseNumberAddition()
    {
        return $this->houseNumberAddition;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getGpsCoordinates(): ?GpsCoordinates
    {
        return $this->gpsCoordinates;
    }

    public function getRijksDriehoek(): ?RijksDriehoek
    {
        return $this->rijksDriehoek;
    }
}
