<?php


class TransCompany implements CarrierInterface
{
    public function calculateShipping( float $weight): float
    {
        if ($weight <= 10) {
            return 20.0;
        }
        return 100.0;
    }
}
