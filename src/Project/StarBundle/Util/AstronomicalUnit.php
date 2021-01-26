<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Util;

use App\Project\StarBundle\Exception\NegativeAstronomicalUnitException;

final class AstronomicalUnit implements AstronomicalUnitInterface
{
    const UNIT = 'AU';

    /** @var float */
    private $value;

    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new NegativeAstronomicalUnitException();
        }

        $this->value = $value;
    }

    public function toString(): string
    {
        return sprintf('%s %s', self::UNIT, number_format($this->value, 2));
    }
}
