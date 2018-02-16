<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Http\Search;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Http\Search\ProfileQuery;

/**
 * @small
 */
final class ProfileQueryTest extends TestCase
{
    /**
     * @test
     * @dataProvider getInteger
     */
    public function setKvkNumber(int $int): void
    {
        $profileQuery = new ProfileQuery();
        $profileQuery->setKvkNumber($int);
        self::assertSame($int, $profileQuery->getKvkNumber());

        $query = $profileQuery->get();
        self::assertSame($int, $query['kvkNumber']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function setBranchNumber(string $string): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setBranchNumber($string);
        self::assertSame($string, $profileQuery->getBranchNumber());

        $query = $profileQuery->get();
        self::assertSame($string, $query['branchNumber']);
    }

    /**
     * @test
     * @dataProvider getInteger
     */
    public function setRsin(int $int): void
    {
        $profileQuery = new ProfileQuery();
        $profileQuery->setRsin($int);
        self::assertSame($int, $profileQuery->getRsin());

        $query = $profileQuery->get();
        self::assertSame($int, $query['rsin']);
    }

    /**
     * @test
     * @dataProvider getBoolean
     */
    public function setIncludeInactiveRegistrations(bool $boolean): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setIncludeInactiveRegistrations($boolean);
        self::assertSame($boolean, $profileQuery->isIncludeInactiveRegistrations());

        $query = $profileQuery->get();
        self::assertSame($boolean, $query['includeInactiveRegistrations']);
    }

    /**
     * @test
     * @dataProvider getBoolean
     */
    public function setRestrictToMainBranch(bool $boolean): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setRestrictToMainBranch($boolean);
        self::assertSame($boolean, $profileQuery->isRestrictToMainBranch());

        $query = $profileQuery->get();
        self::assertSame($boolean, $query['restrictToMainBranch']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function setSite(string $string): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setSite($string);
        self::assertSame($string, $profileQuery->getSite());

        $query = $profileQuery->get();
        self::assertSame($string, $query['site']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function setContext(string $string): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setContext($string);
        self::assertSame($string, $profileQuery->getContext());

        $query = $profileQuery->get();
        self::assertSame($string, $query['context']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function setQ(string $string): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setQ($string);
        self::assertSame($string, $profileQuery->getQ());

        $query = $profileQuery->get();
        self::assertSame($string, $query['q']);
    }

    public function getInteger(): array
    {
        return [
            [0],
            [1],
            [20],
            [300],
            [4000]
        ];
    }

    public function getString(): array
    {
        return [
            ['Lorem'],
            ['ipsum dolor'],
            ['sit amet, consectetuer'],
            ['adipiscing elit. Aenean commodo'],
            ['ligula eget dolor. Aenean massa.']
        ];
    }

    public function getBoolean(): array
    {
        return [
            [true],
            [false]
        ];
    }
}
