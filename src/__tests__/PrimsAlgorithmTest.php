<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\PrimsAlgorithm;
use PHPUnit\Framework\TestCase;

final class PrimsAlgorithmTest extends TestCase
{
    public function testPrimsMinimumSpanningTree(): void
    {
        $this->assertEquals([
            [['to' => 2, 'weight' => 1], ['to' => 1, 'weight' => 3]],
            [['to' => 0, 'weight' => 3], ['to' => 4, 'weight' => 1]],
            [['to' => 0, 'weight' => 1]],
            [['to' => 6, 'weight' => 1]],
            [['to' => 1, 'weight' => 1], ['to' => 5, 'weight' => 2]],
            [['to' => 4, 'weight' => 2], ['to' => 6, 'weight' => 1]],
            [['to' => 5, 'weight' => 1], ['to' => 3, 'weight' => 1]],
        ], PrimsAlgorithm::prims(Fixtures::list1()));
    }
}
