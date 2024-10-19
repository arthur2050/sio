<?php

namespace App\Model\Coupon;

use App\Entity\Coupon;

interface CouponDiscountPriceCalculatorInterface
{
    public function calculate(Coupon $coupon, int $price): float;
}
