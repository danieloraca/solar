<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Twig;

use App\Project\StarBundle\Util\AstronomicalUnit;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AstronomicalUnitExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('astroUnit', [$this, 'convertAstroUnit']),
        ];
    }

    public function convertAstroUnit(float $value): string
    {
        $astronomicalUnit = new AstronomicalUnit($value);

        return $astronomicalUnit->toString();
    }
}
