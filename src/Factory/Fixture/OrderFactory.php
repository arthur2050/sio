<?php

namespace App\Factory\Fixture;

use App\Entity\Coupon;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;

class OrderFactory
{
    /**
     * @param ObjectManager $manager manager
     * @param Product $product product
     * @param Coupon|null $coupon coupon
     * @param string $paymentType payment type
     * @param string $taxNumber tax number
     * @param float $totalPrice total price
     *
     * @return Order
     */
    public static function create(
        ObjectManager $manager,
        Product $product,
        ?Coupon $coupon,
        $paymentType,
        string $taxNumber,
        float $totalPrice
    ): Order {
        $order = new Order();
        $order->setProduct($product);
        $order->setCoupon($coupon);
        $order->setPaymentProcessor($paymentType);
        $order->setTaxNumber($taxNumber);
        $order->setTotalPrice($totalPrice);
        $order->setPaymentSuccessful(true);

        $manager->persist($order);
        $manager->flush();

        return $order;
    }
}
