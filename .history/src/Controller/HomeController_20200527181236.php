<?php

namespace App\Controller;

use App\Repository\BeekeeperRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", schemes={"https"})
     */
    public function index(BeekeeperRepository $beekeeperRepository, ProductRepository $productRepository)
    {
        $newBeekepers = $beekeeperRepository->findLastbeekeepr();
        $newProducts = $productRepository->findLastProductAdded();
        return $this->render('home/index.html.twig', [
            'newBeekeepers' => $newBeekepers,
            'newProducts' => $newProducts
        ]);
    }
}
