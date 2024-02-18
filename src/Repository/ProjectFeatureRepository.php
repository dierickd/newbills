<?php

namespace App\Repository;

use App\Entity\ProjectFeature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectFeature>
 *
 * @method ProjectFeature|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectFeature|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectFeature[]    findAll()
 * @method ProjectFeature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectFeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectFeature::class);
    }

//    /**
//     * @return ProjectFeature[] Returns an array of ProjectFeature objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProjectFeature
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
