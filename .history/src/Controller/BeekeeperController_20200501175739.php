<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BeekeeperController extends AbstractController
{
    /**
     * @Route("/beekeeper", name="beekeeper")
     */
    public function index()
    {
        return $this->render('beekeeper/index.html.twig', [
            'controller_name' => 'BeekeeperController',
        ]);
    }
}
