<?php

declare(strict_types=1);

/**
 * Kata definitions — the PHP analogue of `scripts/dsa.js`.
 *
 * Each entry describes the *interface* of a kata so `scripts/generate.php` can
 * scaffold an empty skeleton for it. There are two kinds:
 *
 *   - 'class' : a class with `properties`, a `constructor` and public `methods`.
 *   - 'fn'    : an algorithm exposed as a single public static method on a class
 *               of the same name (PHP has no top-level exported functions).
 *
 * `doc` / `methodDoc` values are arrays of docblock lines (without the leading
 * " * "). They document array shapes, since PHP arrays are untyped:
 *
 *   BinaryNode : ['value' => int, 'left' => node|null, 'right' => node|null]
 *   GraphEdge  : ['to' => int, 'weight' => int]
 *   Point      : ['x' => int, 'y' => int]
 *   WeightedAdjacencyList   : GraphEdge[][]
 *   WeightedAdjacencyMatrix : int[][]  (0 = no edge)
 */

/**
 * The shared `List` interface (ArrayList, SinglyLinkedList, DoublyLinkedList).
 *
 * @param list<string> $doc      class-level docblock lines
 * @param string       $ctorArgs constructor argument signature
 */
$list = static fn(array $doc, string $ctorArgs = ''): array => [
    'type' => 'class',
    'doc' => $doc,
    'properties' => [
        ['scope' => 'public', 'type' => 'int', 'name' => 'length', 'default' => '0'],
    ],
    'constructor' => ['args' => $ctorArgs],
    'methods' => [
        ['name' => 'prepend', 'args' => 'mixed $item', 'return' => 'void'],
        ['name' => 'insertAt', 'args' => 'mixed $item, int $idx', 'return' => 'void'],
        ['name' => 'append', 'args' => 'mixed $item', 'return' => 'void'],
        ['name' => 'remove', 'args' => 'mixed $item', 'return' => 'mixed'],
        ['name' => 'get', 'args' => 'int $idx', 'return' => 'mixed'],
        ['name' => 'removeAt', 'args' => 'int $idx', 'return' => 'mixed'],
    ],
];

$treeNodeDoc = '@param array{value:int,left:?array,right:?array} $head';
$adjListShape = 'array<int, array<int, array{to:int, weight:int}>>';

return [
    // ----- Data structures -----

    'ArrayList' => $list(
        ['List backed by a growable array. Implement the list interface below.'],
        'int $capacity = 0',
    ),
    'SinglyLinkedList' => $list(['Singly linked list implementing the list interface below.']),
    'DoublyLinkedList' => $list(['Doubly linked list implementing the list interface below.']),

    'Queue' => [
        'type' => 'class',
        'doc' => ['FIFO queue.'],
        'properties' => [['scope' => 'public', 'type' => 'int', 'name' => 'length', 'default' => '0']],
        'constructor' => ['args' => ''],
        'methods' => [
            ['name' => 'enqueue', 'args' => 'mixed $item', 'return' => 'void'],
            ['name' => 'deque', 'args' => '', 'return' => 'mixed'],
            ['name' => 'peek', 'args' => '', 'return' => 'mixed'],
        ],
    ],

    'Stack' => [
        'type' => 'class',
        'doc' => ['LIFO stack.'],
        'properties' => [['scope' => 'public', 'type' => 'int', 'name' => 'length', 'default' => '0']],
        'constructor' => ['args' => ''],
        'methods' => [
            ['name' => 'push', 'args' => 'mixed $item', 'return' => 'void'],
            ['name' => 'pop', 'args' => '', 'return' => 'mixed'],
            ['name' => 'peek', 'args' => '', 'return' => 'mixed'],
        ],
    ],

    'MinHeap' => [
        'type' => 'class',
        'doc' => ['Binary min-heap.'],
        'properties' => [['scope' => 'public', 'type' => 'int', 'name' => 'length', 'default' => '0']],
        'constructor' => ['args' => ''],
        'methods' => [
            ['name' => 'insert', 'args' => 'int $value', 'return' => 'void'],
            ['name' => 'delete', 'args' => '', 'return' => 'int'],
        ],
    ],

    'LRU' => [
        'type' => 'class',
        'doc' => ['Least-Recently-Used cache with a fixed capacity.'],
        'properties' => [['scope' => 'private', 'type' => 'int', 'name' => 'length', 'default' => '0']],
        'constructor' => ['args' => 'int $capacity'],
        'methods' => [
            ['name' => 'update', 'args' => 'mixed $key, mixed $value', 'return' => 'void'],
            ['name' => 'get', 'args' => 'mixed $key', 'return' => 'mixed'],
        ],
    ],

    'Map' => [
        'type' => 'class',
        'doc' => ['Hash map from key to value.'],
        'properties' => [],
        'constructor' => ['args' => ''],
        'methods' => [
            ['name' => 'get', 'args' => 'mixed $key', 'return' => 'mixed'],
            ['name' => 'set', 'args' => 'mixed $key, mixed $value', 'return' => 'void'],
            ['name' => 'delete', 'args' => 'mixed $key', 'return' => 'mixed'],
            ['name' => 'size', 'args' => '', 'return' => 'int'],
        ],
    ],

    'Trie' => [
        'type' => 'class',
        'doc' => ['Prefix tree (trie).'],
        'properties' => [],
        'constructor' => ['args' => ''],
        'methods' => [
            ['name' => 'insert', 'args' => 'string $item', 'return' => 'void'],
            ['name' => 'delete', 'args' => 'string $item', 'return' => 'void'],
            ['name' => 'find', 'args' => 'string $partial', 'return' => 'array', 'doc' => ['@return string[]']],
        ],
    ],

    'RingBuffer' => [
        'type' => 'class',
        'doc' => ['FIFO ring buffer.'],
        'properties' => [['scope' => 'public', 'type' => 'int', 'name' => 'length', 'default' => '0']],
        'constructor' => ['args' => 'int $capacity = 8'],
        'methods' => [
            ['name' => 'push', 'args' => 'mixed $item', 'return' => 'void'],
            ['name' => 'pop', 'args' => '', 'return' => 'mixed'],
            ['name' => 'get', 'args' => 'int $idx', 'return' => 'mixed'],
        ],
    ],

    // ----- Sorting -----

    'BubbleSort' => [
        'type' => 'fn',
        'doc' => ['Bubble sort — sort the array in place ascending.'],
        'fn' => 'bubble_sort', 'args' => 'array &$arr', 'return' => 'void',
        'methodDoc' => ['@param int[] $arr'],
    ],
    'InsertionSort' => [
        'type' => 'fn',
        'doc' => ['Insertion sort — sort the array in place ascending.'],
        'fn' => 'insertion_sort', 'args' => 'array &$arr', 'return' => 'void',
        'methodDoc' => ['@param int[] $arr'],
    ],
    'MergeSort' => [
        'type' => 'fn',
        'doc' => ['Merge sort — sort the array in place ascending.'],
        'fn' => 'merge_sort', 'args' => 'array &$arr', 'return' => 'void',
        'methodDoc' => ['@param int[] $arr'],
    ],
    'QuickSort' => [
        'type' => 'fn',
        'doc' => ['Quick sort — sort the array in place ascending.'],
        'fn' => 'quick_sort', 'args' => 'array &$arr', 'return' => 'void',
        'methodDoc' => ['@param int[] $arr'],
    ],

    // ----- Searching -----

    'LinearSearchList' => [
        'type' => 'fn',
        'doc' => ['Linear search — return true if the needle is present in the haystack.'],
        'fn' => 'linear_search', 'args' => 'array $haystack, int $needle', 'return' => 'bool',
        'methodDoc' => ['@param int[] $haystack'],
    ],
    'BinarySearchList' => [
        'type' => 'fn',
        'doc' => ['Binary search — return true if the needle is present in the sorted haystack.'],
        'fn' => 'bs_list', 'args' => 'array $haystack, int $needle', 'return' => 'bool',
        'methodDoc' => ['@param int[] $haystack'],
    ],
    'TwoCrystalBalls' => [
        'type' => 'fn',
        'doc' => [
            'Two crystal balls — given a boolean array that is false...false then',
            'true...true, return the index of the first true, or -1 if there is none.',
        ],
        'fn' => 'two_crystal_balls', 'args' => 'array $breaks', 'return' => 'int',
        'methodDoc' => ['@param bool[] $breaks'],
    ],

    // ----- Recursion / grids -----

    'MazeSolver' => [
        'type' => 'fn',
        'doc' => [
            'Maze solver — find the path from start to end through the maze.',
            "Points are ['x' => int, 'y' => int]; walls are the given wall character.",
        ],
        'fn' => 'solve', 'args' => 'array $maze, string $wall, array $start, array $end', 'return' => 'array',
        'methodDoc' => [
            '@param string[] $maze',
            '@param array{x:int,y:int} $start',
            '@param array{x:int,y:int} $end',
            '@return array<int,array{x:int,y:int}>',
        ],
    ],

    // ----- Trees -----

    'BTPreOrder' => [
        'type' => 'fn',
        'doc' => ['Pre-order traversal of a binary tree (node, left, right).'],
        'fn' => 'pre_order_search', 'args' => 'array $head', 'return' => 'array',
        'methodDoc' => [$treeNodeDoc, '@return int[]'],
    ],
    'BTInOrder' => [
        'type' => 'fn',
        'doc' => ['In-order traversal of a binary tree (left, node, right).'],
        'fn' => 'in_order_search', 'args' => 'array $head', 'return' => 'array',
        'methodDoc' => [$treeNodeDoc, '@return int[]'],
    ],
    'BTPostOrder' => [
        'type' => 'fn',
        'doc' => ['Post-order traversal of a binary tree (left, right, node).'],
        'fn' => 'post_order_search', 'args' => 'array $head', 'return' => 'array',
        'methodDoc' => [$treeNodeDoc, '@return int[]'],
    ],
    'BTBFS' => [
        'type' => 'fn',
        'doc' => ['Breadth-first search of a binary tree.'],
        'fn' => 'bfs', 'args' => 'array $head, int $needle', 'return' => 'bool',
        'methodDoc' => [$treeNodeDoc],
    ],
    'CompareBinaryTrees' => [
        'type' => 'fn',
        'doc' => ['Structural + value comparison of two binary trees.'],
        'fn' => 'compare', 'args' => '?array $a, ?array $b', 'return' => 'bool',
        'methodDoc' => [
            '@param array{value:int,left:?array,right:?array}|null $a',
            '@param array{value:int,left:?array,right:?array}|null $b',
        ],
    ],
    'DFSOnBST' => [
        'type' => 'fn',
        'doc' => ['Depth-first search on a binary search tree.'],
        'fn' => 'dfs', 'args' => 'array $head, int $needle', 'return' => 'bool',
        'methodDoc' => [$treeNodeDoc],
    ],

    // ----- Graphs -----

    'DFSGraphList' => [
        'type' => 'fn',
        'doc' => [
            'Depth-first search over a weighted adjacency list.',
            'Return the path source..needle as int[], or null if unreachable.',
        ],
        'fn' => 'dfs', 'args' => 'array $graph, int $source, int $needle', 'return' => '?array',
        'methodDoc' => ["@param {$adjListShape} \$graph", '@return int[]|null'],
    ],
    'BFSGraphList' => [
        'type' => 'fn',
        'doc' => [
            'Breadth-first search over a weighted adjacency list.',
            'Return the path source..needle as int[], or null if unreachable.',
        ],
        'fn' => 'bfs', 'args' => 'array $graph, int $source, int $needle', 'return' => '?array',
        'methodDoc' => ["@param {$adjListShape} \$graph", '@return int[]|null'],
    ],
    'BFSGraphMatrix' => [
        'type' => 'fn',
        'doc' => [
            'Breadth-first search over a weighted adjacency matrix (0 = no edge).',
            'Return the path source..needle as int[], or null if unreachable.',
        ],
        'fn' => 'bfs', 'args' => 'array $graph, int $source, int $needle', 'return' => '?array',
        'methodDoc' => ['@param array<int, array<int, int>> $graph', '@return int[]|null'],
    ],
    'DijkstraList' => [
        'type' => 'fn',
        'doc' => [
            'Dijkstra shortest path over a weighted adjacency list.',
            'Return the shortest path from source to sink as int[].',
        ],
        'fn' => 'dijkstra_list', 'args' => 'int $source, int $sink, array $arr', 'return' => 'array',
        'methodDoc' => ["@param {$adjListShape} \$arr", '@return int[]'],
    ],
    'PrimsAlgorithm' => [
        'type' => 'fn',
        'doc' => [
            "Prim's minimum spanning tree over a weighted adjacency list.",
            'Return the MST as a weighted adjacency list, or null if not connected.',
        ],
        'fn' => 'prims', 'args' => 'array $list', 'return' => '?array',
        'methodDoc' => ["@param {$adjListShape} \$list", "@return {$adjListShape}|null"],
    ],
];
