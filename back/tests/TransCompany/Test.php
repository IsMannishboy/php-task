<?php

namespace App\Tests\TransCompany;
use PHPUnit\Framework\TestCase;
use App\Domain\TransCompany;

class TransCompanyTest extends TestCase
{
    public function testCalculate(): void
    {
        $company = new TransCompany();

        $this->assertEquals(20, $company->calculateShipping(10));
        $this->assertEquals(20, $company->calculateShipping(2));

        $this->assertEquals(100, $company->calculateShipping(20));
    }
}