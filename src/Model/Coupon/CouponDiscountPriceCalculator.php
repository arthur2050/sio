<?php

namespace App\Model\Coupon;

use App\Entity\Coupon;

class CouponDiscountPriceCalculator implements CouponDiscountPriceCalculatorInterface
{

    const TYPES = [
        'percent' => 'percent',
        'fixed' => 'fixed',
    ];

    /**
     * @param Coupon $coupon coupon
     * @param int $price price
     *
     * @return float
     */
    public function calculate(Coupon $coupon, int $price): float
    {
        $resultPrice = $price;

        $discountValue = $coupon->getDiscount();
        $discountType = $coupon->getType();

        if (!array_key_exists($discountType, self::TYPES)) {
            throw new \InvalidArgumentException('Invalid discount type');
        }

        if($discountType === 'fixed') {
            $resultPrice = $price - $discountValue;
        } else if ($discountType === 'percent') {
            $resultPrice = $price - ($price*$discountValue/100);
        }

        return $resultPrice;
    }
}
