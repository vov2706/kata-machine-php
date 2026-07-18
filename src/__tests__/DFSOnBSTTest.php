<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\DFSOnBST;
use PHPUnit\Framework\TestCase;

final class DFSOnBSTTest extends TestCase
{
    public function testDfs(): void
    {
        $this->assertTrue(DFSOnBST::dfs(Fixtures::tree(), 45));
        $this->assertTrue(DFSOnBST::dfs(Fixtures::tree(), 7));
        $this->assertFalse(DFSOnBST::dfs(Fixtures::tree(), 69));
    }
}
