<?php

declare(strict_types=1);

namespace Kata;

/**
 * FIFO queue.
 */
class Queue
{
    public int $length = 0;

    public function __construct()
    {
    }

    public function enqueue(mixed $item): void
    {
    }

    public function deque(): mixed
    {
    }

    public function peek(): mixed
    {
    }
}
