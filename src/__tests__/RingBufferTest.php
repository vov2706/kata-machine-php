<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\RingBuffer;
use PHPUnit\Framework\TestCase;

final class RingBufferTest extends TestCase
{
    public function testRingBuffer(): void
    {
        $buffer = new RingBuffer();

        $buffer->push(5);
        $this->assertSame(5, $buffer->pop());
        $this->assertNull($buffer->pop());

        $buffer->push(42);
        $buffer->push(9);
        $this->assertSame(42, $buffer->pop());
        $this->assertSame(9, $buffer->pop());
        $this->assertNull($buffer->pop());

        $buffer->push(42);
        $buffer->push(9);
        $buffer->push(12);
        $this->assertSame(12, $buffer->get(2));
        $this->assertSame(9, $buffer->get(1));
        $this->assertSame(42, $buffer->get(0));
    }
}
