<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\InsertionSort;
use PHPUnit\Framework\TestCase;

final class InsertionSortTest extends TestCase
{
    public function testInsertionSort(): void
    {
        $arr = [9, 3, 7, 4, 69, 420, 42];
        InsertionSort::insertion_sort($arr);
        $this->assertSame([3, 4, 7, 9, 42, 69, 420], $arr);
    }
}
