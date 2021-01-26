<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Entity\SolarSystem;
use App\Project\StarBundle\Exception\DiameterUnavailabeException;
use App\Project\StarBundle\Exception\MassUnavailableException;
use App\Project\StarBundle\Util\Size;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /** @var Size */
    private $size;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(SolarSystem::class);
        $solarSystems = $repository->findAll();

        foreach ($solarSystems as $key => $value) {
            try {
                $mass = $this->size->calculateSolarSystemMass($value);
            } catch (MassUnavailableException $ex) {
                $mass = 0;
            }
            $value->setMass($mass);

            try {
                $diameter = $this->size->calculateDiameter($value);
            } catch (DiameterUnavailabeException $ex) {
                $diameter = 0;
            }
            $value->setCalculatedDiameter($diameter);
        }

        return $this->render('@ProjectStar/main.html.twig', [
            'totalSolarSystems' => count($solarSystems),
            'solarSystems' => $solarSystems,
        ]);
    }

}
