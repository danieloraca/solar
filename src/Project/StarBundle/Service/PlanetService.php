<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Service;

use App\Project\StarBundle\Entity\Planet;
use Doctrine\Persistence\ManagerRegistry;

class PlanetService
{
    /** @var ManagerRegistry */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function createPlanet(PlanetCommand $planetCommand): void
    {
        $planet = new Planet();
        $planet->terraformPlanet(
            $planetCommand->name,
            $planetCommand->mass,
            (float)$planetCommand->distance,
            $planetCommand->star
        );

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($planet);
        $entityManager->flush();
    }
}
