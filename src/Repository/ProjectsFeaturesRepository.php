<?php

namespace App\Repository;

use App\Entity\ProjectsFeatures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectsFeatures>
 *
 * @method ProjectsFeatures|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectsFeatures|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectsFeatures[]    findAll()
 * @method ProjectsFeatures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsFeaturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectsFeatures::class);
    }

//    /**
//     * @return ProjectsFeatures[] Returns an array of ProjectsFeatures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProjectsFeatures
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
