<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BTInOrder;
use PHPUnit\Framework\TestCase;

final class BTInOrderTest extends TestCase
{
    public function testInOrderSearch(): void
    {
        $this->assertSame(
            [5, 7, 10, 15, 20, 29, 30, 45, 50, 100],
            BTInOrder::in_order_search(Fixtures::tree())
        );
    }
}
