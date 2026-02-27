<?php

namespace App\Domain;

interface CarrierInterface
{   
    public function calculateShipping(float $weight): float;
}
