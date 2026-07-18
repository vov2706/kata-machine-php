<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\SinglyLinkedList;
use PHPUnit\Framework\TestCase;

final class SinglyLinkedListTest extends TestCase
{
    public function testSinglyLinkedList(): void
    {
        $list = new SinglyLinkedList();
        Fixtures::testList($list);
    }
}
