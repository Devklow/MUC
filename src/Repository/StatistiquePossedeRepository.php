<?php

namespace App\Repository;

use App\Entity\StatistiquePossede;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatistiquePossede>
 *
 * @method StatistiquePossede|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatistiquePossede|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatistiquePossede[]    findAll()
 * @method StatistiquePossede[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatistiquePossedeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatistiquePossede::class);
    }

    public function add(StatistiquePossede $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StatistiquePossede $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return StatistiquePossede[] Returns an array of StatistiquePossede objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatistiquePossede
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
