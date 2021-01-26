<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Util;

use App\Project\StarBundle\Entity\SolarSystem;

interface SizeInterface
{
    public function calculateSolarSystemMass(SolarSystem $solarSystem): float;
}
