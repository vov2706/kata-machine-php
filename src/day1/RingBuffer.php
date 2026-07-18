<?php

declare(strict_types=1);

namespace Kata;

/**
 * FIFO ring buffer.
 */
class RingBuffer
{
    public int $length = 0;

    public function __construct(int $capacity = 8)
    {
    }

    public function push(mixed $item): void
    {
    }

    public function pop(): mixed
    {
    }

    public function get(int $idx): mixed
    {
    }
}
