<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BFSGraphList;
use PHPUnit\Framework\TestCase;

final class BFSGraphListTest extends TestCase
{
    public function testBfsFindsPath(): void
    {
        $this->assertSame([0, 1, 4, 5, 6], BFSGraphList::bfs(Fixtures::list2(), 0, 6));
    }

    public function testBfsUnreachableReturnsNull(): void
    {
        $this->assertNull(BFSGraphList::bfs(Fixtures::list2(), 6, 0));
    }
}
