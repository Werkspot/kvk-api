<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Api\Profile\Company\Address;

final class RijksDriehoek
{
    private $x;
    private $y;
    private $z;

    public function __construct(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function getZ(): float
    {
        return $this->z;
    }
}
