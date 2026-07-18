<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BTPostOrder;
use PHPUnit\Framework\TestCase;

final class BTPostOrderTest extends TestCase
{
    public function testPostOrderSearch(): void
    {
        $this->assertSame(
            [7, 5, 15, 10, 29, 45, 30, 100, 50, 20],
            BTPostOrder::post_order_search(Fixtures::tree())
        );
    }
}
