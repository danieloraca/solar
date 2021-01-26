<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Entity\SolarSystem;
use App\Project\StarBundle\Exception\DiameterUnavailabeException;
use App\Project\StarBundle\Exception\MassUnavailableException;
use App\Project\StarBundle\Util\Size;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\Json;

class ApiSolarSystemController extends AbstractController
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var Size */
    private $size;

    public function __construct(SerializerInterface $serializer, Size $size)
    {
        $this->serializer = $serializer;
        $this->size = $size;
    }

    public function index(): Response
    {
        $solarSystems = $this->getSerializedSolarSystems();

        return new Response(
            $solarSystems,
            200,
            ['Content-Type' => 'application/json']
        );
    }

    private function getSerializedSolarSystems(): string
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

        return $this->serializer->serialize($solarSystems, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getReference();
            }
        ]);
    }
}
