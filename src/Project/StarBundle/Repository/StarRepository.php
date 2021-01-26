<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Repository;

use App\Project\StarBundle\Entity\Planet;
use App\Project\StarBundle\Entity\Star;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Star::class);
    }

    public function findFurthestPlanet(Star $star): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('MAX(p.distance) as distance')
            ->from(Planet::class, 'p')
            ->where($qb->expr()->eq('p.star', ":star"))
            ->setParameter('star', $star);

        $q = $qb->getQuery();

        return $q->getSingleResult();
    }
}
