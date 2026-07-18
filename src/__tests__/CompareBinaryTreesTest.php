<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\CompareBinaryTrees;
use PHPUnit\Framework\TestCase;

final class CompareBinaryTreesTest extends TestCase
{
    public function testCompare(): void
    {
        $this->assertTrue(CompareBinaryTrees::compare(Fixtures::tree(), Fixtures::tree()));
        $this->assertFalse(CompareBinaryTrees::compare(Fixtures::tree(), Fixtures::tree2()));
    }
}
