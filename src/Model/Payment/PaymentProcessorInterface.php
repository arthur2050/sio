<?php

namespace App\Model\Payment;

interface PaymentProcessorInterface
{
    public function pay(float $amount): void;
}
