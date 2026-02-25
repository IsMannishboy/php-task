<?php


interface CarrierInterface
{   
    public function calculateShipping(float $weight): float;
}
