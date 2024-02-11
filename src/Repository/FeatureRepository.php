<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Feature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Feature>
 *
 * @method Feature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feature[]    findAll()
 * @method Feature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feature::class);
    }

    /**
     * @param Category $category
     * @return array
     */
    public function findByFeatureOrderedByAscName(Category $category): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.category = :id')
            ->setParameter('id', $category)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
