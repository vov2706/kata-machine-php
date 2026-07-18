<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BubbleSort;
use PHPUnit\Framework\TestCase;

final class BubbleSortTest extends TestCase
{
    public function testBubbleSort(): void
    {
        $arr = [9, 3, 7, 4, 69, 420, 42];
        BubbleSort::bubble_sort($arr);
        $this->assertSame([3, 4, 7, 9, 42, 69, 420], $arr);
    }
}
