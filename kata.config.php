<?php

/**
 * Kata configuration — the PHP analogue of `ligma.config.js`.
 *
 * - `day`  : which day folder the tests currently resolve `Kata\*` classes from.
 *            `scripts/generate.php` bumps this when it scaffolds a new day.
 * - `dsa`  : the katas you want to practice. `generate.php` creates an empty
 *            stub for each of these in the new day folder.
 */

return [
    'day' => 'day1',
    'dsa' => [
        // Data structures
        'ArrayList',
        'SinglyLinkedList',
        'DoublyLinkedList',
        'Queue',
        'Stack',
        'MinHeap',
        'LRU',
        'Map',
        'Trie',
        'RingBuffer',

        // Sorting
        'BubbleSort',
        'InsertionSort',
        'MergeSort',
        'QuickSort',

        // Searching
        'LinearSearchList',
        'BinarySearchList',
        'TwoCrystalBalls',

        // Recursion / grids
        'MazeSolver',

        // Trees
        'BTPreOrder',
        'BTInOrder',
        'BTPostOrder',
        'BTBFS',
        'CompareBinaryTrees',
        'DFSOnBST',

        // Graphs
        'DFSGraphList',
        'BFSGraphList',
        'BFSGraphMatrix',
        'DijkstraList',
        'PrimsAlgorithm',
    ],
];
