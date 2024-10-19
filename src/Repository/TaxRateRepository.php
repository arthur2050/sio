<?php

namespace App\Repository;

use App\Entity\TaxRate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaxRateRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxRate::class);
    }

    /**
     * @param TaxRate $taxRate tax rate
     *
     * @return void
     */
    public function save(TaxRate $taxRate): void
    {
        $this->_em->persist($taxRate);
        $this->_em->flush();
    }

    /**
     * @param TaxRate $taxRate tax rate
     *
     * @return void
     */
    public function remove(TaxRate $taxRate): void
    {
        $this->_em->remove($taxRate);
        $this->_em->flush();
    }
}
