<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\Trie;
use PHPUnit\Framework\TestCase;

final class TrieTest extends TestCase
{
    public function testTrie(): void
    {
        $trie = new Trie();

        $trie->insert("foo");
        $trie->insert("fool");
        $trie->insert("foolish");
        $trie->insert("bar");

        $this->assertEqualsCanonicalizing(
            ["foo", "fool", "foolish"],
            $trie->find("fo"),
        );

        $trie->delete("fool");

        $this->assertEqualsCanonicalizing(
            ["foo", "foolish"],
            $trie->find("fo"),
        );
    }
}
