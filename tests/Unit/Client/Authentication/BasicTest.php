<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Tests\Unit\Client\Authentication;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Client\Authentication\Basic;

/**
 * @small
 */
final class BasicTest extends TestCase
{
    private const USERNAME = 'username';
    private const PASSWORD = 'password';
    private const BASE_64_ENCODED = 'dXNlcm5hbWU6cGFzc3dvcmQ=';

    /**
     * @test
     */
    public function getHeader(): void
    {
        $basic = new Basic(self::USERNAME, self::PASSWORD);

        self::assertEquals(sprintf('Authorization:Basic %s', self::BASE_64_ENCODED), $basic->getHeader());
    }
}
