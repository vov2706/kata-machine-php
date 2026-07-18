<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\MergeSort;
use PHPUnit\Framework\TestCase;

final class MergeSortTest extends TestCase
{
    public function testMergeSort(): void
    {
        $arr = [9, 3, 7, 4, 69, 420, 42];
        MergeSort::merge_sort($arr);
        $this->assertSame([3, 4, 7, 9, 42, 69, 420], $arr);
    }
}
