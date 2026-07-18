<?php

declare(strict_types=1);

namespace Kata;

/**
 * Maze solver — find the path from start to end through the maze.
 * Points are ['x' => int, 'y' => int]; walls are the given wall character.
 */
class MazeSolver
{
    /**
     * @param string[] $maze
     * @param array{x:int,y:int} $start
     * @param array{x:int,y:int} $end
     * @return array<int,array{x:int,y:int}>
     */
    public static function solve(array $maze, string $wall, array $start, array $end): array
    {
    }
}
