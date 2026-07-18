<?php

declare(strict_types=1);

namespace Kata\Tests;

use Kata\TwoCrystalBalls;
use PHPUnit\Framework\TestCase;

final class TwoCrystalBallsTest extends TestCase
{
    public function testTwoCrystalBalls(): void
    {
        $idx = random_int(0, 9999);
        $data = array_fill(0, 10000, false);
        for ($i = $idx; $i < 10000; $i++) {
            $data[$i] = true;
        }
        $this->assertSame($idx, TwoCrystalBalls::two_crystal_balls($data));
        $this->assertSame(-1, TwoCrystalBalls::two_crystal_balls(array_fill(0, 821, false)));
    }
}
