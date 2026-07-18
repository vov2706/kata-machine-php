<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\LRU;
use PHPUnit\Framework\TestCase;

final class LRUTest extends TestCase
{
    public function testLRU(): void
    {
        $lru = new LRU(3);

        $this->assertNull($lru->get("foo"));

        $lru->update("foo", 69);
        $this->assertSame(69, $lru->get("foo"));

        $lru->update("bar", 420);
        $this->assertSame(420, $lru->get("bar"));

        $lru->update("baz", 1337);
        $this->assertSame(1337, $lru->get("baz"));

        $lru->update("ball", 69420);
        $this->assertSame(69420, $lru->get("ball"));

        $this->assertNull($lru->get("foo"));
        $this->assertSame(420, $lru->get("bar"));

        $lru->update("foo", 69);
        $this->assertSame(420, $lru->get("bar"));
        $this->assertSame(69, $lru->get("foo"));

        $this->assertNull($lru->get("baz"));
    }
}
