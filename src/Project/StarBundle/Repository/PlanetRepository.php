<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Repository;

use App\Project\StarBundle\Entity\Planet;
use App\Project\StarBundle\Entity\Star;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PlanetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planet::class);
    }
}
