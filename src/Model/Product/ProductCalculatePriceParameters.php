<?php

namespace App\Model\Product;

use App\Model\Payment\PaymentPurchaseParameters;

class ProductCalculatePriceParameters
{
    /**
     * @var mixed
     */
    private $productId;

    /**
     * @var string
     */
    private $taxNumber;

    /**
     * @var string|null
     *
     */
    private $couponCode;


    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId product Id
     *
     * @return self
     */
    public function setProductId($productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    /**
     * @param string $taxNumber tax number
     *
     * @return self
     */
    public function setTaxNumber(string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCouponCode():?string
    {
        return $this->couponCode;
    }

    /**
     * @param string|null $couponCode coupon code
     *
     * @return self
     */
    public function setCouponCode(?string $couponCode): self
    {
        $this->couponCode = $couponCode;

        return $this;
    }
}
