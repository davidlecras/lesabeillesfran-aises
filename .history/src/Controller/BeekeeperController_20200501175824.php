<?php

namespace App\Controller;

use App\Repository\BeekeeperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BeekeeperController extends AbstractController
{
    /**
     * @Route("/beekepers", name="beekeepers")
     */
    public function index(BeekeeperRepository $beekeperRepo)
    {
        $beekeepers = $beekeperRepo->findAll();
        return $this->render('beekeeper/index.html.twig', [
            'beekeepers' => $beekeepers,
        ]);
    }
}
