<?php

use App\Domain\Carrier\CarrierInterface;
use Symfony\Contracts\Service\Attribute\TaggedIterator;

class CompanyTable {
    private array $table;

    public function __construct(#[TaggedIterator('app.carrier')] iterable $carriers) {
        foreach ($carriers as $carrier) {
            $this->table[strtolower((new \ReflectionClass($carrier))->getShortName())] = $carrier;
        }
    }

    public function get(string $key): ?CarrierInterface {
        return $this->table[$key] ?? null;
    }
}