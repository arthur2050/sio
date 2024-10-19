<?php

namespace App\Factory\Fixture;

use App\Entity\Coupon;
use Doctrine\Persistence\ObjectManager;

class CouponFactory
{
    /**
     * @param ObjectManager $manager manager
     *
     * @param string $code code
     * @param float $value value
     * @param string $type type
     *
     * @return Coupon
     */
    public static function create(ObjectManager $manager, string $code, float $value, string $type): Coupon
    {
        $coupon = new Coupon();
        $coupon->setCode($code);
        $coupon->setDiscount($value);
        $coupon->setType($type);

        $manager->persist($coupon);
        $manager->flush();

        return $coupon;
    }
}
