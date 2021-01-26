<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Exception;

class MassUnavailableException extends \Exception
{
    /** @var string */
    protected $message = 'Mass not set';
}
