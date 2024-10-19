<?php

namespace App\Model\Product;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Model\Coupon\CouponDiscountPriceCalculatorInterface;
use App\Model\TaxRate\TaxRatePriceCalculatorInterface;


class ProductPriceCalculator implements ProductPriceCalculatorInterface
{
    /**
     * @param CouponDiscountPriceCalculatorInterface $couponDiscountPriceCalculator coupon discount price calculator
     * @param TaxRatePriceCalculatorInterface $taxRatePriceCalculator tax rate priceCalculator
     */
    public function __construct(
        private CouponDiscountPriceCalculatorInterface $couponDiscountPriceCalculator,
        private TaxRatePriceCalculatorInterface $taxRatePriceCalculator,
    ) {}

    /**
     * @param Product $product product
     * @param string $taxNumber tax number
     * @param Coupon|null $coupon coupon
     *
     * @return float
     */
    public function calculate(Product $product, string $taxNumber, ?Coupon $coupon): float
    {
        if (!$product) {
            throw new \InvalidArgumentException("Product not found.");
        }

        $price = $product->getPrice();

        $price = $this->getTaxRate($taxNumber, $price);

        if ($coupon) {
            $price = $this->applyDiscount($price, $coupon);
        }

        return $price;
    }

    /**
     * @param string $taxNumber tax number
     * @param $price
     *
     * @return float
     */
    private function getTaxRate(string $taxNumber, $price): float
    {
        return $this->taxRatePriceCalculator->calculate($taxNumber, $price);
    }

    /**
     * @param float $price price
     * @param Coupon $coupon coupon
     *
     * @return float
     */
    private function applyDiscount(float $price, Coupon $coupon): float
    {
        return $this->couponDiscountPriceCalculator->calculate($coupon, $price);
    }
}
