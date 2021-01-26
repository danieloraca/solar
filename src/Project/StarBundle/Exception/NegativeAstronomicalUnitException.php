<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Exception;

class NegativeAstronomicalUnitException extends \Exception
{
    /** @var string */
    protected $message = 'An Astronomical Unit cannot have negative values';
}
