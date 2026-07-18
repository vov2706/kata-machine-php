<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\ArrayList;
use PHPUnit\Framework\TestCase;

final class ArrayListTest extends TestCase
{
    public function testArrayList(): void
    {
        $list = new ArrayList(3);
        Fixtures::testList($list);
    }
}
