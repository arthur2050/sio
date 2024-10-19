<?php

namespace App\Model\Payment;

use App\Exception\PaymentFailedException;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor as BaseStripePaymentProcessor;
class StripePaymentProcessor implements PaymentProcessorInterface
{
    private $baseStripePaymentProcessor;

    /**
     * @param BaseStripePaymentProcessor $baseStripePaymentProcessor
     */
    public function __construct()
    {
        $this->baseStripePaymentProcessor = new BaseStripePaymentProcessor();
    }

    /**
     * @param float $amount amount
     *
     * @return void
     */
    public function pay(float $amount): void
    {
        $success = $this->baseStripePaymentProcessor->processPayment((int)$amount);

        if (!$success) {
            throw new PaymentFailedException("Unsuccessful strip payment.");
        }
    }
}
