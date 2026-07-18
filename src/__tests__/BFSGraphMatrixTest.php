<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\BFSGraphMatrix;
use PHPUnit\Framework\TestCase;

final class BFSGraphMatrixTest extends TestCase
{
    public function testBfsFindsPath(): void
    {
        $this->assertSame([0, 1, 4, 5, 6], BFSGraphMatrix::bfs(Fixtures::matrix2(), 0, 6));
    }

    public function testBfsUnreachableReturnsNull(): void
    {
        $this->assertNull(BFSGraphMatrix::bfs(Fixtures::matrix2(), 6, 0));
    }
}
