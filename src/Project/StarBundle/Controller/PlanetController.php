<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Entity\Planet;
use App\Project\StarBundle\Form\Type\PlanetType;
use App\Project\StarBundle\Repository\StarRepository;
use App\Project\StarBundle\Service\PlanetCommand;
use App\Project\StarBundle\Service\PlanetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanetController extends AbstractController
{
    /** @var PlanetService */
    private $planetService;

    public function __construct(PlanetService $planetService)
    {
        $this->planetService = $planetService;
    }

    public function add(Request $request, StarRepository $starRepository): Response
    {
        $planet = new Planet();
        $form = $this->createForm(PlanetType::class, $planet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planetCommand = new PlanetCommand();
            $formPlanet = $request->request->get('planet');

            $planetCommand->name = $formPlanet['name'];
            $planetCommand->mass = $formPlanet['mass'];
            $planetCommand->distance = $formPlanet['distance'];
            $planetCommand->star = $starRepository->find($request->get('starReference'));

            $this->planetService->createPlanet($planetCommand);

            return $this->redirectToRoute('view_star', [
                'starReference' => $request->get('starReference')
            ]);
        }

        return $this->render('@ProjectStar/planet/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
