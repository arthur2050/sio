<?php

namespace App\Factory\Payment;

use App\Model\Payment\PaymentProcessorInterface;
use App\Model\Payment\PaypalPaymentProcessor;
use App\Model\Payment\StripePaymentProcessor;


class PaymentProcessorFactory implements PaymentProcessorFactoryInterface
{
    const array TYPES = [
        'paypal' => PaypalPaymentProcessor::class,
        'stripe' => StripePaymentProcessor::class,
    ];

    /**
     * @param string $type type
     *
     * @return PaymentProcessorInterface
     */
    public function create(string $type): PaymentProcessorInterface
    {
        if (array_key_exists($type, self::TYPES)) {
            $class = self::TYPES[$type];
            return new $class();
        } else {
            throw new \LogicException('Unknown payment processor type "' . $type . '"');
        }
    }
}
