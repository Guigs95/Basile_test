<?php

namespace App\Controller;

use App\Service\ApiBasileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Job;

class HomeController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("/", name="home")
     */
    public function index(ApiBasileService $apiBasileService): Response
    {
        $data = $apiBasileService->getData(); # get data from database
        
        return $this->render('liste_emploi.html.twig', [
            'data' => $data,
        ]);
    }
}
