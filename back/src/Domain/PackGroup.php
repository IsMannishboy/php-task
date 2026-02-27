<?php

namespace App\Domain;
class PackGroup implements CarrierInterface
{
    
    public function calculateShipping(float $weight): float
    {
        return $weight;
    }
}
