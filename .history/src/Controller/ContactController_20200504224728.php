<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/#formContact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
