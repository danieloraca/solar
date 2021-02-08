<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Entity;

use Ramsey\Uuid\Uuid;

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
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
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
     * @return Star
     */
    public function getStar(): Star
    {
        return $this->star;
    }

    public function terraformPlanet(string $name, string $mass, float $distance, Star $star): void
    {
        $this->reference = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->mass = $mass;
        $this->distance = $distance;
        $this->star = $star;
    }
}
