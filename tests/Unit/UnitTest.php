<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_calculation_of_addition(): void
    {
        $this->assertTrue(true);
        $this->assertEquals(5, $this->add(2, 3));
    }

    public function add($a, $b)
    {
        return $a + $b;
    }
}
