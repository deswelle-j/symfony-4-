<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

//    /**
//     * @return Event[] Returns an array of Event objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function search( $term ){
        $stmt = $this->createQueryBuilder('e');
        $stmt->where('e.name LIKE :term');
        $stmt->setParameter('term','%' . $term . '%');
        return $stmt->getQuery()->getResult();
    }

    public function countPendding(){
        $stmt = $this->createQueryBuilder('e');
        $stmt->select('count(e)');
        $stmt->where('e.startAt > :now');
        $stmt->setParameter('now', new \Datetime);
        return $stmt->getQuery()->getSingleScalarResult();
    }

    public function getevents( $filter ){
        $stmt = $this->createQueryBuilder('e');
        $stmt->orderBy('e.name', $filter);
        return $stmt->getQuery()
        ->getResult();
    }


    public function getEventByName($name)
    {
        $stmt = $this->createQueryBuilder('e');
        $stmt->andWhere('e.name LIKE :val');
        $stmt->setParameter('val', $name);
        $stmt->orderBy('e.name', 'ASC');
        return $stmt->getQuery()
        ->getResult();
        
    }
}
