<?php

namespace App\Tests\PackGroup;
use PHPUnit\Framework\TestCase;
use App\Domain\PackGroup;

class PackGroupTest extends TestCase
{
    public function testCalculate(): void
    {
        $company = new PackGroup();

        $this->assertEquals(20, $company->calculateShipping(20));
        $this->assertEquals(100, $company->calculateShipping(100));

    }
}