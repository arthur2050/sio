<?php

namespace App\Model\Product;

use App\Entity\Coupon;
use App\Entity\Product;

interface ProductPriceCalculatorInterface
{
    public function calculate(Product $product, string $taxNumber, Coupon $coupon): float;
}
