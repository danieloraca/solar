<?php
declare(strict_types=1);

namespace App\Project\StarBundle\Controller;

use App\Project\StarBundle\Exception\ApiNotAvailableException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function index(): Response
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->generateUrl('api_solar_systems', [], UrlGeneratorInterface::ABSOLUTE_URL)
            );
        } catch (TransportExceptionInterface $e) {
            return $this->render('@ProjectStar/error.html.twig');
        }

        try {
            $solarSystems = json_decode($response->getContent(), true);
        } catch (ClientExceptionInterface $e) {
            return $this->render('@ProjectStar/error.html.twig');
        }


        return $this->render('@ProjectStar/main.html.twig', [
            'totalSolarSystems' => count($solarSystems),
            'solarSystems' => $solarSystems,
        ]);
    }

}
