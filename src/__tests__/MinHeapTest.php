<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\MinHeap;
use PHPUnit\Framework\TestCase;

final class MinHeapTest extends TestCase
{
    public function testMinHeap(): void
    {
        $heap = new MinHeap();

        $this->assertSame(0, $heap->length);

        $heap->insert(5);
        $heap->insert(3);
        $heap->insert(69);
        $heap->insert(420);
        $heap->insert(4);
        $heap->insert(1);
        $heap->insert(8);
        $heap->insert(7);

        $this->assertSame(8, $heap->length);
        $this->assertSame(1, $heap->delete());
        $this->assertSame(3, $heap->delete());
        $this->assertSame(4, $heap->delete());
        $this->assertSame(5, $heap->delete());
        $this->assertSame(4, $heap->length);
        $this->assertSame(7, $heap->delete());
        $this->assertSame(8, $heap->delete());
        $this->assertSame(69, $heap->delete());
        $this->assertSame(420, $heap->delete());
        $this->assertSame(0, $heap->length);
    }
}
