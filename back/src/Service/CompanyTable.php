<?php
namespace App\Service;

use Symfony\Contracts\Service\Attribute\TaggedIterator;


class CompanyTable {
    public array $table;
    
    public function __construct(#[TaggedIterator('app.carrier')] iterable $carriers) {
        foreach ($carriers as $carrier) {
            $this->table[strtolower((new \ReflectionClass($carrier))->getShortName())] = $carrier;
        }
    }
    public function getAll(): array
    {
        
        $keysArray = [];
        foreach ($this->table as $key => $carrier) {
            $keysArray[] = $key;
        }

        return $keysArray;
    }
   public function get(string $name)
    {
        $name = strtolower($name);
        return $this->table[$name] ?? null;
    }
    
}