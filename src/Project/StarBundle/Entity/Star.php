<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Star
{
    /** @var string */
    protected $reference;

    /** @var string */
    protected $name;

    /** @var string */
    protected $mass;

    /** @var SolarSystem */
    protected $solarSystem;

    /** @var ArrayCollection<Planet> */
    protected $planets;

    public function __construct()
    {
        $this->planets = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getMass(): string
    {
        return $this->mass;
    }

    /**
     * @param string $mass
     */
    public function setMass(string $mass): void
    {
        $this->mass = $mass;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlanets(): ArrayCollection
    {
        return new ArrayCollection($this->planets->toArray());
    }

    /**
     * @param ArrayCollection $planets
     */
    public function setPlanets(ArrayCollection $planets): void
    {
        $this->planets = $planets;
    }

    /**
     * @return ?SolarSystem
     */
    public function getSolarSystem(): ?SolarSystem
    {
        return $this->solarSystem;
    }

    /**
     * @param SolarSystem $solarSystem
     */
    public function setSolarSystem(SolarSystem $solarSystem): void
    {
        $this->solarSystem = $solarSystem;
    }
}
