<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BTBFS;
use PHPUnit\Framework\TestCase;

final class BTBFSTest extends TestCase
{
    public function testBfs(): void
    {
        $this->assertTrue(BTBFS::bfs(Fixtures::tree(), 45));
        $this->assertTrue(BTBFS::bfs(Fixtures::tree(), 7));
        $this->assertFalse(BTBFS::bfs(Fixtures::tree(), 69));
    }
}
