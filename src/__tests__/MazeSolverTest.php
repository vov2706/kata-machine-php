<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\MazeSolver;
use PHPUnit\Framework\TestCase;

final class MazeSolverTest extends TestCase
{
    public function testMazeSolver(): void
    {
        $maze = [
            "xxxxxxxxxx x",
            "x        x x",
            "x        x x",
            "x xxxxxxxx x",
            "x          x",
            "x xxxxxxxxxx",
        ];
        $expected = [
            ['x' => 10, 'y' => 0], ['x' => 10, 'y' => 1], ['x' => 10, 'y' => 2], ['x' => 10, 'y' => 3], ['x' => 10, 'y' => 4],
            ['x' => 9, 'y' => 4], ['x' => 8, 'y' => 4], ['x' => 7, 'y' => 4], ['x' => 6, 'y' => 4], ['x' => 5, 'y' => 4],
            ['x' => 4, 'y' => 4], ['x' => 3, 'y' => 4], ['x' => 2, 'y' => 4], ['x' => 1, 'y' => 4], ['x' => 1, 'y' => 5],
        ];
        $result = MazeSolver::solve($maze, "x", ['x' => 10, 'y' => 0], ['x' => 1, 'y' => 5]);
        $this->assertSame($this->drawPath($maze, $expected), $this->drawPath($maze, $result));
    }

    /** @param string[] $data @param array<int,array{x:int,y:int}> $path @return string[] */
    private function drawPath(array $data, array $path): array
    {
        $grid = array_map(static fn(string $row) => str_split($row), $data);
        foreach ($path as $p) {
            if (isset($grid[$p['y']][$p['x']])) {
                $grid[$p['y']][$p['x']] = '*';
            }
        }
        return array_map(static fn(array $row) => implode('', $row), $grid);
    }
}
