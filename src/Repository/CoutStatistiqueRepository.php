<?php

namespace App\Repository;

use App\Entity\CoutStatistique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoutStatistique>
 *
 * @method CoutStatistique|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoutStatistique|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoutStatistique[]    findAll()
 * @method CoutStatistique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoutStatistiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoutStatistique::class);
    }

    public function add(CoutStatistique $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CoutStatistique $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CoutStatistique[] Returns an array of CoutStatistique objects
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

//    public function findOneBySomeField($value): ?CoutStatistique
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
