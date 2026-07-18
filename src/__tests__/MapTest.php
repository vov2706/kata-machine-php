<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\Map;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    public function testMap(): void
    {
        $map = new Map();

        $map->set("foo", 55);
        $this->assertSame(1, $map->size());

        $map->set("fool", 75);
        $this->assertSame(2, $map->size());

        $map->set("foolish", 105);
        $this->assertSame(3, $map->size());

        $map->set("bar", 69);
        $this->assertSame(4, $map->size());

        $this->assertSame(69, $map->get("bar"));
        $this->assertNull($map->get("blaz"));

        $map->delete("barblabr");
        $this->assertSame(4, $map->size());

        $map->delete("bar");
        $this->assertSame(3, $map->size());
        $this->assertNull($map->get("bar"));
    }
}
