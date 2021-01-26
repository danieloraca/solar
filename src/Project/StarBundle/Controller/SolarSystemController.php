<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Entity\SolarSystem;
use App\Project\StarBundle\Form\Type\SolarSystemDiameterType;
use App\Project\StarBundle\Form\Type\SolarSystemType;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SolarSystemController extends AbstractController
{
    public function add(Request $request): Response
    {
        $solarSystem = new SolarSystem();

        $form = $this->createForm(SolarSystemType::class, $solarSystem);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $solarSystem = $form->getData();
            $solarSystem->setReference(Uuid::uuid4()->toString());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solarSystem);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('@ProjectStar/solar-system/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function updateDiameter(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(SolarSystem::class);
        $solarSystem = $repository->findOneBy(['reference' => $request->get('solarSystemReference')]);

        $form = $this->createForm(SolarSystemDiameterType::class, $solarSystem);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $solarSystem = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solarSystem);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('@ProjectStar/solar-system/update_diameter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
