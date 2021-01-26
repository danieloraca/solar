<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Tests\Util;

use App\Project\StarBundle\Exception\NegativeAstronomicalUnitException;
use App\Project\StarBundle\Util\AstronomicalUnit;
use PHPUnit\Framework\TestCase;

class AstronomicalUnitTest extends TestCase
{
    public function testCreateAstronomicalUnit(): void
    {
        $astronomicalUnit = new AstronomicalUnit(123);

        $this->assertEquals('AU 123.00', $astronomicalUnit->toString());
    }

    public function testAstronomicalUnitNegative(): void
    {
        $this->expectException(NegativeAstronomicalUnitException::class);

        $astronomicalUnit = new AstronomicalUnit(-123);
    }
}
