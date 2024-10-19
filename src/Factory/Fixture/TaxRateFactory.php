<?php

namespace App\Factory\Fixture;

use App\Entity\TaxRate;
use Doctrine\Persistence\ObjectManager;

class TaxRateFactory
{
    /**
     * @param ObjectManager $manager manager
     * @param string $countryCode country code
     * @param float $rate rate
     *
     * @return TaxRate
     */
    public static function create(ObjectManager $manager, string $countryCode, float $rate): TaxRate
    {
        $taxRate = new TaxRate();
        $taxRate->setCountryCode($countryCode);
        $taxRate->setRate($rate);

        $manager->persist($taxRate);
        $manager->flush();

        return $taxRate;
    }
}
