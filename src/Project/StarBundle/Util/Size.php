<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Util;

use App\Project\StarBundle\Entity\Planet;
use App\Project\StarBundle\Entity\SolarSystem;
use App\Project\StarBundle\Entity\Star;
use App\Project\StarBundle\Exception\DiameterUnavailabeException;
use App\Project\StarBundle\Exception\MassUnavailableException;
use App\Project\StarBundle\Repository\StarRepository;

class Size implements SizeInterface
{
    /** @var StarRepository */
    private $starRepository;

    public function __construct(StarRepository $starRepository)
    {
        $this->starRepository = $starRepository;
    }

    public function calculateSolarSystemMass(SolarSystem $solarSystem): float
    {
        $mass = 0;

        if ($solarSystem->getStars()->isEmpty()) {
            throw new MassUnavailableException();
        } else {
            /** @var Star $star */
            foreach ($solarSystem->getStars() as $star) {
                if ((float)$star->getMass() === 0.0) {
                    throw new MassUnavailableException();
                }
                $mass += (float)$star->getMass();
                /** @var Planet $planet */
                foreach ($star->getPlanets() as $planet) {
                    if ((float)$planet->getMass() === 0.0) {
                        throw new MassUnavailableException();
                    }
                    $mass += (float)$planet->getMass();
                }
            }
        }

        return $mass;
    }

    /**
     * https://www.physicsforums.com/threads/solar-system-diameter.998883/#post-6448493
     * Asked the question on how a diameter is calculated and looks like it has nothing to do with distances
     *
     * @param SolarSystem $solarSystem
     * @return float
     * @throws DiameterUnavailabeException
     */
    public function calculateDiameter(SolarSystem $solarSystem): float
    {
        $distance = 0;

        if ($solarSystem->getStars()->isEmpty()) {
            throw new DiameterUnavailabeException();
        } else {
            /** @var Star $star */
            foreach ($solarSystem->getStars() as $star) {
                $furthest = $this->starRepository->findFurthestPlanet($star);

                $distance += $furthest['distance'];
            }
        }

        return $distance * 2;
    }
}
