<?php

namespace App\Repository;

use App\DTO\SearchDTO;
use App\Entity\Project;
use App\Services\Constants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function search(?SearchDTO $searchDto): Query
    {
        $checkboxChecked = array_keys((array)$searchDto, true, true);
        $query = $this->createQueryBuilder('p');
        $orStatements = $query->expr()->orX();

        foreach ($checkboxChecked as $v) {
            $status = Constants::getStatusByName($v);
            $orStatements->add(
                $query->expr()->eq('p.status', $status)
            );
        }
        $query->andWhere($orStatements);
        $query->andWhere('p.name LIKE :search')
            ->setParameter('search', '%' . $searchDto?->search . '%')
            ->orderBy('p.created_at', 'DESC');

        return $query->getQuery();
    }
}
