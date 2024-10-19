<?php

namespace App\Manager;

use App\Model\Payment\PaymentProcessorInterface;

class PaymentProcessorManager implements PaymentProcessorManagerInterface
{
    /**
     * @var PaymentProcessorInterface
     */
    private PaymentProcessorInterface $processor;

    /**
     * @param float $amount amount
     *
     * @return void
     */
    public function pay(float $amount)
    {
        $this->processor->pay($amount);
    }

    /**
     * @param PaymentProcessorInterface $processor processor
     *
     * @return static
     */
    public function setProcessor(PaymentProcessorInterface $processor): static
    {
        $this->processor = $processor;

        return $this;
    }
}
