<?php

namespace App\Repository;

use App\Entity\TypePlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypePlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePlace[]    findAll()
 * @method TypePlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePlaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypePlace::class);
    }

//    /**
//     * @return TypePlace[] Returns an array of TypePlace objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypePlace
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
