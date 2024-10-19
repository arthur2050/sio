<?php

namespace App\DataFixtures;

use App\Factory\Fixture\CouponFactory;
use App\Factory\Fixture\ProductFactory;
use App\Factory\Fixture\TaxRateFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        // Создаём продукты
        $iphone = ProductFactory::create($manager, 'Iphone', 100.00);
        $headphones = ProductFactory::create($manager, 'Headphones', 20.00);
        $case = ProductFactory::create($manager, 'Case', 10.00);

        // Создаём купоны
        $discountTenPercent = CouponFactory::create($manager, 'D10', 10, 'percent');
        $discountFiveFixed = CouponFactory::create($manager, 'D5', 5, 'fixed');

        // DE123456789, IT12345678901, GR123456789
        $taxRateGermany = TaxRateFactory::create($manager, 'DE', 19.00);
        $taxRateItaly = TaxRateFactory::create($manager, 'IT', 22.00);
        $taxRateGreece = TaxRateFactory::create($manager, 'GR', 24.00);

    }
}
