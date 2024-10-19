<?php

namespace App\Factory\Fixture;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;

class ProductFactory
{
    /**
     * @param ObjectManager $manager manager
     * @param string $name name
     * @param float $price price
     *
     * @return Product
     */
    public static function create(ObjectManager $manager, string $name, float $price): Product
    {
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);

        $manager->persist($product);
        $manager->flush();

        return $product;
    }
}
