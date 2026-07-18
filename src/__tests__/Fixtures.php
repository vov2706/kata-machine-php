<?php

declare(strict_types=1);

namespace Kata\Tests;

use PHPUnit\Framework\Assert;

/**
 * Shared test data and helpers — the PHP port of `graph.ts`, `tree.ts` and
 * `ListTest.ts`.
 *
 * Data-structure representations (mirroring the original TypeScript types):
 *   - BinaryNode : ['value' => int, 'left' => node|null, 'right' => node|null]
 *   - GraphEdge  : ['to' => int, 'weight' => int]
 *   - Point      : ['x' => int, 'y' => int]
 *   - WeightedAdjacencyList   : GraphEdge[][]
 *   - WeightedAdjacencyMatrix : int[][]  (a number means weight)
 */
final class Fixtures
{
    /** Binary search tree used by the tree-traversal katas. */
    public static function tree(): array
    {
        return [
            'value' => 20,
            'right' => [
                'value' => 50,
                'right' => ['value' => 100, 'right' => null, 'left' => null],
                'left' => [
                    'value' => 30,
                    'right' => ['value' => 45, 'right' => null, 'left' => null],
                    'left' => ['value' => 29, 'right' => null, 'left' => null],
                ],
            ],
            'left' => [
                'value' => 10,
                'right' => ['value' => 15, 'right' => null, 'left' => null],
                'left' => [
                    'value' => 5,
                    'right' => ['value' => 7, 'right' => null, 'left' => null],
                    'left' => null,
                ],
            ],
        ];
    }

    /** A structurally different tree, for CompareBinaryTrees. */
    public static function tree2(): array
    {
        return [
            'value' => 20,
            'right' => [
                'value' => 50,
                'right' => null,
                'left' => [
                    'value' => 30,
                    'right' => [
                        'value' => 45,
                        'right' => ['value' => 49, 'left' => null, 'right' => null],
                        'left' => null,
                    ],
                    'left' => [
                        'value' => 29,
                        'right' => null,
                        'left' => ['value' => 21, 'right' => null, 'left' => null],
                    ],
                ],
            ],
            'left' => [
                'value' => 10,
                'right' => ['value' => 15, 'right' => null, 'left' => null],
                'left' => [
                    'value' => 5,
                    'right' => ['value' => 7, 'right' => null, 'left' => null],
                    'left' => null,
                ],
            ],
        ];
    }

    /**
     * Undirected weighted graph (adjacency list).
     *
     *      (1) --- (4) ---- (5)
     *    /  |       |       /|
     * (0)   | ------|------- |
     *    \  |/      |        |
     *      (2) --- (3) ---- (6)
     */
    public static function list1(): array
    {
        return [
            [['to' => 1, 'weight' => 3], ['to' => 2, 'weight' => 1]],
            [['to' => 0, 'weight' => 3], ['to' => 2, 'weight' => 4], ['to' => 4, 'weight' => 1]],
            [['to' => 1, 'weight' => 4], ['to' => 3, 'weight' => 7], ['to' => 0, 'weight' => 1]],
            [['to' => 2, 'weight' => 7], ['to' => 4, 'weight' => 5], ['to' => 6, 'weight' => 1]],
            [['to' => 1, 'weight' => 1], ['to' => 3, 'weight' => 5], ['to' => 5, 'weight' => 2]],
            [['to' => 6, 'weight' => 1], ['to' => 4, 'weight' => 2], ['to' => 2, 'weight' => 18]],
            [['to' => 3, 'weight' => 1], ['to' => 5, 'weight' => 1]],
        ];
    }

    /**
     * Directed weighted graph (adjacency list).
     *
     *     >(1)<--->(4) ---->(5)
     *    /          |       /|
     * (0)     ------|------- |
     *    \   v      v        v
     *     >(2) --> (3) <----(6)
     */
    public static function list2(): array
    {
        return [
            [['to' => 1, 'weight' => 3], ['to' => 2, 'weight' => 1]],
            [['to' => 4, 'weight' => 1]],
            [['to' => 3, 'weight' => 7]],
            [],
            [['to' => 1, 'weight' => 1], ['to' => 3, 'weight' => 5], ['to' => 5, 'weight' => 2]],
            [['to' => 2, 'weight' => 18], ['to' => 6, 'weight' => 1]],
            [['to' => 3, 'weight' => 1]],
        ];
    }

    /** The same directed graph as list2, expressed as a weighted matrix. */
    public static function matrix2(): array
    {
        return [
            [0, 3, 1, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 0, 0],
            [0, 0, 7, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0],
            [0, 1, 0, 5, 0, 2, 0],
            [0, 0, 18, 0, 0, 0, 1],
            [0, 0, 0, 1, 0, 0, 1],
        ];
    }

    /**
     * Shared exercise for every `List` implementation (ArrayList, SinglyLinkedList,
     * DoublyLinkedList). Missing values are represented by `null` in PHP where the
     * original TypeScript returned `undefined`.
     */
    public static function testList(object $list): void
    {
        $list->append(5);
        $list->append(7);
        $list->append(9);

        Assert::assertSame(9, $list->get(2));
        Assert::assertSame(7, $list->removeAt(1));
        Assert::assertSame(2, $list->length);

        $list->append(11);
        Assert::assertSame(9, $list->removeAt(1));
        Assert::assertNull($list->remove(9));
        Assert::assertSame(5, $list->removeAt(0));
        Assert::assertSame(11, $list->removeAt(0));
        Assert::assertSame(0, $list->length);

        $list->prepend(5);
        $list->prepend(7);
        $list->prepend(9);

        Assert::assertSame(5, $list->get(2));
        Assert::assertSame(9, $list->get(0));
        Assert::assertSame(9, $list->remove(9));
        Assert::assertSame(2, $list->length);
        Assert::assertSame(7, $list->get(0));
    }
}
