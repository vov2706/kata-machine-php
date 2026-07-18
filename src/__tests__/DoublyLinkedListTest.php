<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\DoublyLinkedList;
use PHPUnit\Framework\TestCase;

final class DoublyLinkedListTest extends TestCase
{
    public function testDoublyLinkedList(): void
    {
        $list = new DoublyLinkedList();
        Fixtures::testList($list);
    }
}
