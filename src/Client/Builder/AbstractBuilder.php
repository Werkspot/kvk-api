<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Client\Builder;

abstract class AbstractBuilder
{
    protected function extractStringOrNull(string $key, array $data): ?string
    {
        return $this->extract($key, $data);
    }

    protected function extractIntegerOrNull(string $key, array $data): ?int
    {
        return (int) $this->extract($key, $data) ?? null;
    }

    protected function extractFloatOrNull(string $key, array $data): ?float
    {
        return (float) $this->extract($key, $data) ?? null;
    }

    protected function extractBoolean(string $key, array $data): bool
    {
        return (bool) $this->extract($key, $data);
    }

    protected function extractArrayOrNull(string $key, array $data): ?array
    {
        return $this->extract($key, $data);
    }

    private function extract(string $key, array $data)
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }

        return null;
    }
}
