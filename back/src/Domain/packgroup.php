<?php


class PackGroup implements CarrierInterface
{
    public function calculateShipping(float $weight): float
    {
        return $weight;
    }
}
