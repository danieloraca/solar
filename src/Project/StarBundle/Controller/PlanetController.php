<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Entity\Planet;
use App\Project\StarBundle\Form\Type\PlanetType;
use App\Project\StarBundle\Repository\StarRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanetController extends AbstractController
{
    public function add(Request $request, StarRepository $starRepository): Response
    {
        $planet = new Planet();
        $form = $this->createForm(PlanetType::class, $planet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planet = $form->getData();
            $planet->setReference(Uuid::uuid4()->toString());
            $star = $starRepository->find($request->get('starReference'));
            $planet->setStar($star);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planet);
            $entityManager->flush();

            return $this->redirectToRoute('view_star', [
                'starReference' => $request->get('starReference')
            ]);
        }

        return $this->render('@ProjectStar/planet/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
