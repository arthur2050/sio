<?php

namespace App\Model\Payment;

class PaymentPurchaseParameters
{
    /**
     * @var int
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
     * @var string
     */
    private $paymentType;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId product Id
     *
     * @return self
     */
    public function setProductId(int $productId): self
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

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType payment type
     *
     * @return self
     */
    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }
}
