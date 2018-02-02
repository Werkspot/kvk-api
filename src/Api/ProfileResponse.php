<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Api;

use Werkspot\KvkApi\Api\Profile\Company;

final class ProfileResponse implements ResponseInterface
{
    private $itemsPerPage;
    private $startPage;
    private $totalItems;
    private $companies;
    private $nextUrl;
    private $previousUrl;

    public function __construct(
        int $itemsPerPage,
        int $startPage,
        int $totalItems,
        array $companies,
        ?string $nextLink = null,
        ?string $previousLink = null
    ) {
        $this->itemsPerPage = $itemsPerPage;
        $this->startPage = $startPage;
        $this->totalItems = $totalItems;
        $this->companies = $companies;
        $this->nextUrl = $nextLink;
        $this->previousUrl = $previousLink;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function getStartPage(): int
    {
        return $this->startPage;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @return Company[]
     */
    public function getCompanies(): array
    {
        return $this->companies;
    }

    public function getNextUrl(): ?string
    {
        return $this->nextUrl;
    }

    public function getPreviousUrl(): ?string
    {
        return $this->previousUrl;
    }
}
