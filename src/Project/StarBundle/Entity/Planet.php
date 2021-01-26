<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Entity;

class Planet
{
    /** @var string */
    protected $reference;

    /** @var string */
    protected $name;

    /** @var string */
    protected $mass;

    /** @var float */
    protected $distance;

    /** @var Star */
    protected $star;

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
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
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
     * @return Star
     */
    public function getStar(): Star
    {
        return $this->star;
    }

    /**
     * @param Star $star
     */
    public function setStar(Star $star): void
    {
        $this->star = $star;
    }
}
