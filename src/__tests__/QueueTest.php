<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\Queue;
use PHPUnit\Framework\TestCase;

final class QueueTest extends TestCase
{
    public function testQueue(): void
    {
        $list = new Queue();

        $list->enqueue(5);
        $list->enqueue(7);
        $list->enqueue(9);

        $this->assertSame(5, $list->deque());
        $this->assertSame(2, $list->length);

        $list->enqueue(11);
        $this->assertSame(7, $list->deque());
        $this->assertSame(9, $list->deque());
        $this->assertSame(11, $list->peek());
        $this->assertSame(11, $list->deque());
        $this->assertNull($list->deque());
        $this->assertSame(0, $list->length);

        // make sure we don't blow up when everything is removed
        $list->enqueue(69);
        $this->assertSame(69, $list->peek());
        $this->assertSame(1, $list->length);
    }
}
