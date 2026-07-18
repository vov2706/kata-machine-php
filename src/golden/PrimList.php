<?php

declare(strict_types=1);

namespace Kata\Golden;

/**
 * Prim's algorithm :: minimum spanning tree.
 *
 * Reference solution — the PHP port of `src/golden/PrimList.ts`. This folder
 * holds worked answers and is NOT wired into the test suite or the generator;
 * it is kept purely for reference, separate from the practice skeletons in
 * `src/dayN`.
 *
 * What is a minimum spanning tree?
 *  - Requires no cycles
 *  - To technically be a minimum spanning tree, the graph must be strongly
 *    connected
 *
 * 1. Select a starting node
 * 2. Put the edges of the currently selected node into a list
 * 3. Select the lowest-value edge to a node we haven't seen yet
 * 4. Insert the edge from current to new into our mst
 * 5. The newly selected node becomes the current node
 * 6. Repeat from step 2 until unvisited is empty or unreachable
 *
 * @param array<int, array<int, array{to:int, weight:int}>> $list
 * @return array<int, array<int, array{to:int, weight:int}>>|null
 */
function prims(array $list): ?array
{
    $visited = array_fill(0, count($list), false);

    /** @var array<int, array<int, array{to:int, weight:int}>> $mst */
    $mst = array_map(static fn() => [], $list);

    // 1.
    $visited[0] = true;
    $current = 0;

    // edges holds pairs [from, edge]
    /** @var array<int, array{0:int, 1:array{to:int, weight:int}}> $edges */
    $edges = [];

    do {
        // 2. put all dem edges in the list
        foreach ($list[$current] as $edge) {
            $edges[] = [$current, $edge];
        }

        // 3. select the lowest-value edge to a node we haven't seen yet
        $lowest = INF;
        $lowestIdx = -1;
        foreach ($edges as $idx => [$from, $edge]) {
            if ($visited[$edge['to']] === false && $edge['weight'] < $lowest) {
                $lowest = $edge['weight'];
                $lowestIdx = $idx;
            }
        }

        // 4. insert the edge current -> new into the mst, mark visited, drop the edge
        if ($lowestIdx !== -1) {
            [$from, $edge] = $edges[$lowestIdx];
            $mst[$from][] = $edge;
            $mst[$edge['to']][] = ['to' => $from, 'weight' => $edge['weight']];
            $visited[$edge['to']] = true;
            array_splice($edges, $lowestIdx, 1);

            // 5. the newly selected node becomes the current node
            $current = $edge['to'];
        } else {
            $current = -1;
        }
    } while (in_array(false, $visited, true) && $current >= 0);

    return $mst;
}

// Run directly with:  php src/golden/PrimList.php
if (isset($argv[0]) && realpath($argv[0]) === __FILE__) {
    $result = prims([
        [ // 0
            ['to' => 2, 'weight' => 1],
            ['to' => 1, 'weight' => 3],
        ],
        [ // 1
            ['to' => 0, 'weight' => 3],
            ['to' => 4, 'weight' => 1],
            ['to' => 3, 'weight' => 3],
        ],
        [ // 2
            ['to' => 0, 'weight' => 1],
            ['to' => 3, 'weight' => 7],
        ],
        [ // 3
            ['to' => 6, 'weight' => 1],
            ['to' => 1, 'weight' => 3],
            ['to' => 2, 'weight' => 7],
        ],
        [ // 4
            ['to' => 1, 'weight' => 1],
            ['to' => 5, 'weight' => 2],
        ],
        [ // 5
            ['to' => 4, 'weight' => 2],
            ['to' => 6, 'weight' => 1],
        ],
        [ // 6
            ['to' => 5, 'weight' => 1],
            ['to' => 3, 'weight' => 1],
        ],
    ]);

    print_r($result);
}
