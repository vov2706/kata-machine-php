<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BinarySearchList;
use PHPUnit\Framework\TestCase;

final class BinarySearchListTest extends TestCase
{
    public function testBinarySearch(): void
    {
        $foo = [1, 3, 4, 69, 71, 81, 90, 99, 420, 1337, 69420];
        $this->assertTrue(BinarySearchList::bs_list($foo, 69));
        $this->assertFalse(BinarySearchList::bs_list($foo, 1336));
        $this->assertTrue(BinarySearchList::bs_list($foo, 69420));
        $this->assertFalse(BinarySearchList::bs_list($foo, 69421));
        $this->assertTrue(BinarySearchList::bs_list($foo, 1));
        $this->assertFalse(BinarySearchList::bs_list($foo, 0));
    }
}
