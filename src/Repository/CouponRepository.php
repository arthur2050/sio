<?php

namespace App\Repository;

use App\Entity\Coupon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CouponRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry  registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    /**
     * @param Coupon $coupon coupon
     *
     * @return void
     */
    public function save(Coupon $coupon): void
    {
        $this->_em->persist($coupon);
        $this->_em->flush();
    }

    /**
     * @param Coupon $coupon coupon
     *
     * @return void
     */
    public function remove(Coupon $coupon): void
    {
        $this->_em->remove($coupon);
        $this->_em->flush();
    }
}
