<?php

declare(strict_types=1);

namespace Kata;

/**
 * Depth-first search over a weighted adjacency list.
 * Return the path source..needle as int[], or null if unreachable.
 */
class DFSGraphList
{
    /**
     * @param array<int, array<int, array{to:int, weight:int}>> $graph
     * @return int[]|null
     */
    public static function dfs(array $graph, int $source, int $needle): ?array
    {
    }
}
