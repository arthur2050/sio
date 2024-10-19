<?php

namespace App\Model\TaxRate;

use App\Repository\TaxRateRepository;

class TaxRatePriceCalculator implements TaxRatePriceCalculatorInterface
{
    /**
     * @param TaxRateRepository $taxRateRepository $tax rate repository
     */
    public function __construct(private TaxRateRepository $taxRateRepository)
    {}

    /**
     * @param string $taxNumber tax number
     * @param float $price price
     *
     * @return float
     */
    public function calculate(string $taxNumber, float $price): float
    {
        $countryCode = $this->getCountryCodeFromTaxNumber($taxNumber);
        $taxRate = $this->taxRateRepository->findOneBy(['countryCode' => $countryCode]);

        if (!$taxRate) {
            throw new \InvalidArgumentException('Invalid tax number or country code.');
        }

        return $price+ $price * ($taxRate->getRate() / 100);
    }

    /**
     * @param string $taxNumber tax number
     *
     * @return string
     */
    private function getCountryCodeFromTaxNumber(string $taxNumber): string
    {
        // Логика извлечения кода страны из налогового номера
        if (str_starts_with($taxNumber, 'DE')) {
            return 'DE';
        } elseif (str_starts_with($taxNumber, 'IT')) {
            return 'IT';
        } elseif (str_starts_with($taxNumber, 'GR')) {
            return 'GR';
        } elseif (str_starts_with($taxNumber, 'FR')) {
            return 'FR';
        }

        throw new \InvalidArgumentException('Unsupported country code.');
    }
}
