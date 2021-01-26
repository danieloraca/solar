<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class SolarSystem
{
    /** @var string */
    protected $reference;

    /** @var string */
    protected $name;

    /** @var float */
    protected $diameter;

    /** @var ?float */
    protected $calculatedDiameter;

    /** @var ArrayCollection */
    protected $stars;

    /** @var ?float */
    protected $mass;

    public function __construct()
    {
        $this->stars = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): SolarSystem
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): SolarSystem
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param ArrayCollection $stars
     */
    public function setStars(ArrayCollection $stars): void
    {
        $this->stars = $stars;
    }

    /**
     * @return ArrayCollection
     */
    public function getStars(): ArrayCollection
    {
        return new ArrayCollection($this->stars->toArray());
    }

    /**
     * @return ?float
     */
    public function getDiameter(): ?float
    {
        return $this->diameter;
    }

    /**
     * @param float $diameter
     */
    public function setDiameter(float $diameter): void
    {
        $this->diameter = $diameter;
    }

    /**
     * @return ?float
     */
    public function getMass(): ?float
    {
        return $this->mass;
    }

    /**
     * @param float $mass
     */
    public function setMass(float $mass): void
    {
        $this->mass = $mass;
    }

    /**
     * @return ?float
     */
    public function getCalculatedDiameter(): ?float
    {
        return $this->calculatedDiameter;
    }

    /**
     * @param float $calculatedDiameter
     */
    public function setCalculatedDiameter(float $calculatedDiameter): void
    {
        $this->calculatedDiameter = $calculatedDiameter;
    }
}
