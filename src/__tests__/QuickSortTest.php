<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\QuickSort;
use PHPUnit\Framework\TestCase;

final class QuickSortTest extends TestCase
{
    public function testQuickSort(): void
    {
        $arr = [9, 3, 7, 4, 69, 420, 42];
        QuickSort::quick_sort($arr);
        $this->assertSame([3, 4, 7, 9, 42, 69, 420], $arr);
    }
}
