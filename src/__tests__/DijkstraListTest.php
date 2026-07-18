<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\DijkstraList;
use PHPUnit\Framework\TestCase;

final class DijkstraListTest extends TestCase
{
    public function testDijkstraShortestPath(): void
    {
        $this->assertSame([0, 1, 4, 5, 6], DijkstraList::dijkstra_list(0, 6, Fixtures::list1()));
    }
}
