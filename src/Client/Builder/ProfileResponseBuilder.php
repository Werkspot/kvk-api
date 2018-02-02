<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder;

use Werkspot\KvkApi\Api\Profile\Company;
use Werkspot\KvkApi\Api\ProfileResponse;
use Werkspot\KvkApi\Client\Builder\Profile\CompanyBuilderInterface;

final class ProfileResponseBuilder extends AbstractBuilder implements ProfileResponseBuilderInterface
{
    /**
     * @var CompanyBuilderInterface
     */
    private $companyBuilder;

    public function __construct(CompanyBuilderInterface $companyBuilder)
    {
        $this->companyBuilder = $companyBuilder;
    }

    public function fromData(array $data): ProfileResponse
    {
        return new ProfileResponse(
            $this->extractIntegerOrNull('itemsPerPage', $data),
            $this->extractIntegerOrNull('startPage', $data),
            $this->extractIntegerOrNull('totalItems', $data),
            $this->extractCompanies($data['items']),
            $this->extractStringOrNull('nextLink', $data),
            $this->extractStringOrNull('previousLink', $data)
        );
    }

    /**
     * @return Company[]
     */
    private function extractCompanies(array $data): array
    {
        $companies = [];

        foreach ($data  as $company) {
            $companies[] = $this->companyBuilder->fromArray($company);
        }

        return $companies;
    }
}
