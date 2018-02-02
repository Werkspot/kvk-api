<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Client\Builder\Profile\Company;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Builder\Profile\Company\BusinessActivityBuilder;

/**
 * @small
 */
final class BusinessActivityBuilderTest extends TestCase
{
    /**
     * @test
     * @dataProvider getArrayData
     */
    public function fromArray(array $data): void
    {
        $builder = new BusinessActivityBuilder();

        $output = $builder->fromArray($data);
        foreach ($output as $index => $businessActivity) {
            self::assertEquals($data[$index]['sbiCode'], $businessActivity->getSbiCode());
            self::assertEquals($data[$index]['sbiCodeDescription'], $businessActivity->getSbiCodeDescription());
            self::assertEquals($data[$index]['isMainSbi'], $businessActivity->isMainSbi());
        }
    }

    public function getArrayData(): array
    {
        return [
            [
                [
                    [
                        'sbiCode' => '3030',
                        'sbiCodeDescription' => 'Vervaardiging van vliegtuigen en onderdelen daarvoor',
                        'isMainSbi' => true
                    ],

                    [
                        'sbiCode' => '4773',
                        'sbiCodeDescription' => 'Apotheken',
                        'isMainSbi' => false
                    ],

                    [
                        'sbiCode' => '3040',
                        'sbiCodeDescription' => 'Vervaardiging van militaire gevechtsvoertuigen',
                        'isMainSbi' => false
                    ]
                ]
            ]
        ];
    }
}
