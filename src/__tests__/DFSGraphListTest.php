<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\DFSGraphList;
use PHPUnit\Framework\TestCase;

final class DFSGraphListTest extends TestCase
{
    public function testDfsFindsPath(): void
    {
        $this->assertSame([0, 1, 4, 5, 6], DFSGraphList::dfs(Fixtures::list2(), 0, 6));
    }

    public function testDfsUnreachableReturnsNull(): void
    {
        $this->assertNull(DFSGraphList::dfs(Fixtures::list2(), 6, 0));
    }
}
