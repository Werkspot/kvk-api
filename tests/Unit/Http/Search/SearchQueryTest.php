<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Unit\Http\Search;

use PHPUnit\Framework\TestCase;
use Werkspot\KvkApi\Http\Search\SearchQuery;

/**
 * @small
 *
 * @internal
 */
final class SearchQueryTest extends TestCase
{
    /**
     * @test
     * @dataProvider getInteger
     */
    public function set_kvk_number(string $int): void
    {
        $searchQuery = new SearchQuery();
        $searchQuery->setKvkNumber($int);
        self::assertSame($int, $searchQuery->getKvkNumber());

        $query = $searchQuery->get();
        self::assertSame($int, $query['kvkNumber']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_branch_number(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setBranchNumber($string);
        self::assertSame($string, $searchQuery->getBranchNumber());

        $query = $searchQuery->get();
        self::assertSame($string, $query['branchNumber']);
    }

    /**
     * @test
     * @dataProvider getInteger
     */
    public function set_rsin(int $int): void
    {
        $searchQuery = new SearchQuery();
        $searchQuery->setRsin($int);
        self::assertSame($int, $searchQuery->getRsin());

        $query = $searchQuery->get();
        self::assertSame($int, $query['rsin']);
    }

    /**
     * @test
     * @dataProvider getBoolean
     */
    public function set_include_inactive_registrations(bool $boolean): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setIncludeInactiveRegistrations($boolean);
        self::assertSame($boolean, $searchQuery->isIncludeInactiveRegistrations());

        $query = $searchQuery->get();
        self::assertSame($boolean, $query['includeInactiveRegistrations']);
    }

    /**
     * @test
     * @dataProvider getBoolean
     */
    public function set_restrict_to_main_branch(bool $boolean): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setRestrictToMainBranch($boolean);
        self::assertSame($boolean, $searchQuery->isRestrictToMainBranch());

        $query = $searchQuery->get();
        self::assertSame($boolean, $query['restrictToMainBranch']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_site(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setSite($string);
        self::assertSame($string, $searchQuery->getSite());

        $query = $searchQuery->get();
        self::assertSame($string, $query['site']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_context(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setContext($string);
        self::assertSame($string, $searchQuery->getContext());

        $query = $searchQuery->get();
        self::assertSame($string, $query['context']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_q(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setFreeTextQuery($string);
        self::assertSame($string, $searchQuery->getFreeTextQuery());

        $query = $searchQuery->get();
        self::assertSame($string, $query['q']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_housenumber(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setHouseNumber($string);
        self::assertSame($string, $searchQuery->getHouseNumber());

        $query = $searchQuery->get();
        self::assertSame($string, $query['houseNumber']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_street(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setStreet($string);
        self::assertSame($string, $searchQuery->getStreet());

        $query = $searchQuery->get();
        self::assertSame($string, $query['street']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_postalcode(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setPostalCode($string);
        self::assertSame($string, $searchQuery->getPostalCode());

        $query = $searchQuery->get();
        self::assertSame($string, $query['postalCode']);
    }

    /**
     * @test
     * @dataProvider getString
     */
    public function set_city(string $string): void
    {
        $searchQuery =  new SearchQuery();
        $searchQuery->setCity($string);
        self::assertSame($string, $searchQuery->getCity());

        $query = $searchQuery->get();
        self::assertSame($string, $query['city']);
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
