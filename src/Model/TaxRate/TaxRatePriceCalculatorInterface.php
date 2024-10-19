<?php

namespace App\Model\TaxRate;

interface TaxRatePriceCalculatorInterface
{
    public function calculate(string $taxNumber, float $price): float;
}
