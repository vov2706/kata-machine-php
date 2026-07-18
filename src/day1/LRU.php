<?php

declare(strict_types=1);

namespace Kata;

/**
 * Least-Recently-Used cache with a fixed capacity.
 */
class LRU
{
    private int $length = 0;

    public function __construct(int $capacity)
    {
    }

    public function update(mixed $key, mixed $value): void
    {
    }

    public function get(mixed $key): mixed
    {
    }
}
