<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Entity\Star;
use App\Project\StarBundle\Form\Type\StarType;
use App\Project\StarBundle\Repository\SolarSystemRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StarController extends AbstractController
{
    public function view(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Star::class);
        $star = $repository->findOneBy(['reference' => $request->get('starReference')]);

        return $this->render('@ProjectStar/star/view.html.twig', [
            'star' => $star,
        ]);
    }

    public function add(Request $request, SolarSystemRepository $solarSystemRepository): Response
    {
        $star = new Star();
        $star->setName('Star 1');

        $form = $this->createForm(StarType::class, $star);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $star = $form->getData();
            $star->setReference(Uuid::uuid4()->toString());
            $solarSystem = $solarSystemRepository->find($request->attributes->get('solarSystemReference'));
            $star->setSolarSystem($solarSystem);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($star);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('@ProjectStar/star/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
