<?php

namespace App\Controller;

use App\Service\ApiBasileService;
use App\Controller\HomeController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Job;

class ActionController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("/load", name="loadApiData")
     */
    public function callApiAction(ApiBasileService $apiBasileService) 
    {
        $saved = $apiBasileService->saveData(); # save data from api to database

        $data = $apiBasileService->getData(); # get data from postgresql database
        
        return $this->render('liste_emploi.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/reset", name="resetApiData")
     */
    public function resestAction(ApiBasileService $apiBasileService) 
    {
        $deleted = $apiBasileService->resetData(); # delete data from api to database

        $data = $apiBasileService->getData(); # get data from postgresql database

        return $this->render('liste_emploi.html.twig', [
            'data' => $data,
        ]);
    }
}
