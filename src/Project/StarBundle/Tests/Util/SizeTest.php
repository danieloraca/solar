<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Tests\Util;

use App\Project\StarBundle\Entity\Planet;
use App\Project\StarBundle\Entity\SolarSystem;
use App\Project\StarBundle\Entity\Star;
use App\Project\StarBundle\Exception\DiameterUnavailabeException;
use App\Project\StarBundle\Exception\MassUnavailableException;
use App\Project\StarBundle\Repository\StarRepository;
use App\Project\StarBundle\Util\Size;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class SizeTest extends TestCase
{
    /** @var Size */
    private $size;

    /** @var SolarSystem */
    private $solarSystem;

    /** @var Star */
    private $star;

    /** @var Planet */
    private $planet;

    /** @var StarRepository */
    private $starRepository;

    public function setUp(): void
    {
        $this->starRepository = $this->createMock(StarRepository::class);
        $this->size = new Size($this->starRepository);
        $this->solarSystem = new SolarSystem();
    }

    public function testCalculateMassSolarSystemMass(): void
    {
        $this->star = new Star();
        $this->star->setMass('5');
        $this->planet = new Planet();
        $this->planet->setMass('2');
        $this->star->setPlanets(new ArrayCollection([$this->planet]));
        $this->solarSystem->setStars(new ArrayCollection([$this->star]));

        $result = $this->size->calculateSolarSystemMass($this->solarSystem);

        $this->assertEquals(7, $result);
    }

    public function testCalculateMassWhenMassZero():void
    {
        $this->star = new Star();
        $this->star->setMass('0');
        $this->expectException(MassUnavailableException::class);

        $this->size->calculateSolarSystemMass($this->solarSystem);
    }

    public function testCalculateDiameterWhenNoValues(): void
    {
        $this->solarSystem = new SolarSystem();
        $this->expectException(DiameterUnavailabeException::class);

        $this->size->calculateDiameter($this->solarSystem);
    }
}
