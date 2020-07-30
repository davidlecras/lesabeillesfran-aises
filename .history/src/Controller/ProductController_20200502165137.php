<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/produits", name="showAllProducts")
     */
    public function showAllProducts(ProductRepository $repo, PaginatorInterface $paginatorInterface, Request $request)
    {
        $products = $paginatorInterface->paginate(
            $repo->findAllWithPagination(),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('product/products.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/produitDetail/{product}", name="show_product")
     */
    public function showProduct($product, ProductRepository $productRepository)
    {
        return $this->render('product/showProduct.html.twig', [
            'product' => $productRepository->productDetails($product),
        ]);
    }
}
