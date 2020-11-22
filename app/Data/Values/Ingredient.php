<?php

namespace App\Data\Values;

class Ingredient
{
    public string $name;
    public float $quantity;
    public float $price;
    public float $total;

    public function __construct(string $name, float $quantity = 0, float $price = 0)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $this->calculateTotal();
    }

    public function calculateTotal()
    {
        return $this->quantity * $this->price;
    }
}
