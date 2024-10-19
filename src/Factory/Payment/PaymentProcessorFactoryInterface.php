<?php

namespace App\Factory\Payment;

interface PaymentProcessorFactoryInterface
{
    public function create(string $type);
}
