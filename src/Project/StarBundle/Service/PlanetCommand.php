<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Service;

use App\Project\StarBundle\Entity\Star;

class PlanetCommand
{
    /** @var string */
    public $name;

    /** @var string */
    public $mass;

    /** @var float */
    public $distance;

    /** @var Star */
    public $star;
}
