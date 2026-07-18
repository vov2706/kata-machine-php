<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\Stack;
use PHPUnit\Framework\TestCase;

final class StackTest extends TestCase
{
    public function testStack(): void
    {
        $list = new Stack();

        $list->push(5);
        $list->push(7);
        $list->push(9);

        $this->assertSame(9, $list->pop());
        $this->assertSame(2, $list->length);

        $list->push(11);
        $this->assertSame(11, $list->pop());
        $this->assertSame(7, $list->pop());
        $this->assertSame(5, $list->peek());
        $this->assertSame(5, $list->pop());
        $this->assertNull($list->pop());

        $list->push(69);
        $this->assertSame(69, $list->peek());
        $this->assertSame(1, $list->length);
    }
}
