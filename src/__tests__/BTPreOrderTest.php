<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BTPreOrder;
use PHPUnit\Framework\TestCase;

final class BTPreOrderTest extends TestCase
{
    public function testPreOrderSearch(): void
    {
        $this->assertSame(
            [20, 10, 5, 7, 15, 50, 30, 29, 45, 100],
            BTPreOrder::pre_order_search(Fixtures::tree())
        );
    }
}
