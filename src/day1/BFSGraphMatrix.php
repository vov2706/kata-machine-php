<?php

declare(strict_types=1);

namespace Kata;

/**
 * Breadth-first search over a weighted adjacency matrix (0 = no edge).
 * Return the path source..needle as int[], or null if unreachable.
 */
class BFSGraphMatrix
{
    /**
     * @param array<int, array<int, int>> $graph
     * @return int[]|null
     */
    public static function bfs(array $graph, int $source, int $needle): ?array
    {
    }
}
