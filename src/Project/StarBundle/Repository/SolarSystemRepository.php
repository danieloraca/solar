<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Repository;

use Doctrine\ORM\Query\Expr\Join;
use App\Project\StarBundle\Entity\SolarSystem;
use App\Project\StarBundle\Entity\Star;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class SolarSystemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SolarSystem::class);
    }

    public function findAll(): array
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
