<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\LinearSearchList;
use PHPUnit\Framework\TestCase;

final class LinearSearchListTest extends TestCase
{
    public function testLinearSearch(): void
    {
        $foo = [1, 3, 4, 69, 71, 81, 90, 99, 420, 1337, 69420];
        $this->assertTrue(LinearSearchList::linear_search($foo, 69));
        $this->assertFalse(LinearSearchList::linear_search($foo, 1336));
        $this->assertTrue(LinearSearchList::linear_search($foo, 69420));
        $this->assertFalse(LinearSearchList::linear_search($foo, 69421));
        $this->assertTrue(LinearSearchList::linear_search($foo, 1));
        $this->assertFalse(LinearSearchList::linear_search($foo, 0));
    }
}
