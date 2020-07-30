<?php

namespace App\Controller;

use App\Entity\Coments;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/produit/{id}", name="show_product")
     */
    public function showProduct(Product $products, ProductRepository $productRepository)
    {
        return $this->render('product/showProduct.html.twig', [
            'products' => $products,
            'product' => $productRepository->productDetails($products),
        ]);
    }

    /**
     * @Route("/new-comment/{product}", methods={"POST"}, name="new_comment")
     */
    public function newComment(Product $video, Request $request, EntityManagerInterface $em)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        if (!empty(trim($request->request->get('comment')))) {
            $comment = new Coments();
            $comment->setContaint($request->request->get('comment'));
            $comment->setUser($this->getUser());
            $comment->setProduct($video);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->redirectToRoute('video_details', ['video' => $video->getId()]);
    }
}
