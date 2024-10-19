<?php

namespace App\Model\Payment;

use App\Exception\PaymentFailedException;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor as BasePaypalPaymentProcessor;
class PaypalPaymentProcessor implements PaymentProcessorInterface
{
    /**
     * @var BasePaypalPaymentProcessor
     */
    private $basePaypalPaymentProcessor;

    public function __construct()
    {
        $this->basePaypalPaymentProcessor = new BasePaypalPaymentProcessor();
    }

    /**
     * @param float $amount amount
     *
     * @return void
     */
    public function pay(float $amount): void
    {
        try {
            $this->basePaypalPaymentProcessor->pay((int)$amount);
        } catch (\Exception $e) {
            throw new PaymentFailedException($e->getMessage());
        }
    }
}
