<?php

namespace App\Manager;

interface PaymentProcessorManagerInterface
{
    public function pay(float $amount);
}
