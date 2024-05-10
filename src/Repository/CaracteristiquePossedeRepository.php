<?php

namespace App\Repository;

use App\Entity\CaracteristiquePossede;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CaracteristiquePossede>
 *
 * @method CaracteristiquePossede|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaracteristiquePossede|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaracteristiquePossede[]    findAll()
 * @method CaracteristiquePossede[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristiquePossedeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CaracteristiquePossede::class);
    }

    public function add(CaracteristiquePossede $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CaracteristiquePossede $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CaracteristiquePossede[] Returns an array of CaracteristiquePossede objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CaracteristiquePossede
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
