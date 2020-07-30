<?php

namespace App\Controller;

use App\Entity\Beekeeper;
use App\Entity\Product;
use App\Form\BeekeeperType;
use App\Form\ProductType;
use App\Repository\BeekeeperRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="main_page_admin",schemes={"https"})
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/beekeeper", name="beekeeper_main_page_admin")
     */
    public function beekeeperMainPage(BeekeeperRepository $repoBee)
    {
        $Beekeepers = $repoBee->findAll();
        return $this->render('admin/beekeeperMainPage.html.twig', [
            'beekeepers' => $Beekeepers,
        ]);
    }

    /**
     * @Route("/products", name="products_main_page_admin")
     */
    public function productsMainPage(ProductRepository $repoProd)
    {
        $products = $repoProd->findAll();
        return $this->render('admin/productsMainPage.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/addBeekeeper", name="addBeekeeper")
     * @Route("/editBeekeeper/{id}", name="editBeekeeper", methods="GET|POST")
     */
    public function editBeekeeper(Beekeeper $beekeeper = null, Request $request, EntityManagerInterface $manager)
    {
        if (!$beekeeper) {
            $beekeeper = new Beekeeper();
            $beekeeper->setCreatedAt(new \DateTime());
        }
        $form = $this->createForm(BeekeeperType::class, $beekeeper);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($beekeeper);
            $manager->flush();
            $this->addFlash('success', "L'action a bien été effectuée");
            return $this->redirectToRoute('beekeeper_main_page_admin');
        }
        return $this->render('admin/beekeeperModification.html.twig', [
            'beekeeper' => $beekeeper,
            'form' => $form->createView(),
            'isModification' => $beekeeper->getId() !== null
        ]);
    }

    /**
     * @Route("/addProduct", name="addProduct")
     * @Route("/editProduct/{id}", name="editProduct")
     */
    public function editProduct(Product $product = null, Request $request, EntityManagerInterface $manager)
    {
        if (!$product) {
            $product = new Product();
            $product->setCreatedAt(new \DateTime());
        }
        $formP = $this->createForm(ProductType::class, $product);
        $formP->handleRequest($request);
        if ($formP->isSubmitted() && $formP->isValid()) {
            $manager->persist($product);
            $manager->flush();
            $this->addFlash('success', "L'action a bien été effectuée");
            return $this->redirectToRoute('products_main_page_admin');
        }
        return $this->render('admin/productModification.html.twig', [
            'product' => $product,
            'formP' => $formP->createView(),
            'isModification' => $product->getId() !== null
        ]);
    }

    /**
     * @Route("/removeBeekeeper/{id}", name="remove_beekeeper", methods="delete")
     */
    public function removeBeekeeper(Beekeeper $beekeeper, Request $request, EntityManagerInterface $manager)
    {
        if ($this->isCsrfTokenValid("SUP" . $beekeeper->getid(), $request->get('_token'))) {
            $manager->remove($beekeeper);
            $manager->flush();
            return $this->redirectToRoute("beekeeper_main_page_admin");
        }
    }

    /**
     * @Route("/removeProduct/{id}", name="remove_product", methods="delete")
     */
    public function removeProduct(Product $product, Request $request, EntityManagerInterface $manager)
    {
        if ($this->isCsrfTokenValid("SUP" . $product->getid(), $request->get('_token'))) {
            $manager->remove($product);
            $manager->flush();
            return $this->redirectToRoute("products_main_page_admin");
        }
    }
}
