<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Unit\Http\Search;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Http\Search\ProfileQuery;

/**
 * @small
 *
 * @internal
 */
final class ProfileQueryTest extends TestCase
{
    /**
     * @test
     * @dataProvider getInteger
     */
    public function set_kvk_number(string $int): void
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
    public function set_branch_number(string $string): void
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
    public function set_rsin(int $int): void
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
    public function set_include_inactive_registrations(bool $boolean): void
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
    public function set_restrict_to_main_branch(bool $boolean): void
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
    public function set_site(string $string): void
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
    public function set_context(string $string): void
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
    public function set_q(string $string): void
    {
        $profileQuery =  new ProfileQuery();
        $profileQuery->setFreeTextQuery($string);
        self::assertSame($string, $profileQuery->getFreeTextQuery());

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
