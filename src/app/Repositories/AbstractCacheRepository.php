<?php

namespace App\Repositories;

abstract class AbstractCacheRepository
{
    protected function makeKey(string $functionName, ...$params): string
    {
        return $this->cachePrefix . '.' . $functionName . '.' . implode('.', $params);
    }

    public function makeGetTreeKey(int $id): string
    {
        return $this->cachePrefix . '.getTree.' . $id;
    }
}
