<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Exception;

class DiameterUnavailabeException extends \Exception
{
    /** @var string */
    protected $message = 'Diameter not available';
}
