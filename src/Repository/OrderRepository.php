<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OrderRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @param Order $order order
     *
     * @return void
     */
    public function save(Order $order): void
    {
        $this->_em->persist($order);
        $this->_em->flush();
    }

    /**
     * @param Order $order order
     *
     * @return void
     */
    public function remove(Order $order): void
    {
        $this->_em->remove($order);
        $this->_em->flush();
    }
}
