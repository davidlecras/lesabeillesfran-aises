<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/MyprofileCreation", name="user_creation")
     */
    public function user_creation(Request $request, UserPasswordEncoderInterface $encode, EntityManagerInterface $manager)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypte = $encode->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordCrypte);
            $user->setRoles('ROLE_USER');
            $user->setCreatedAt(new \DateTime('now'));
            $manager->persist($user);
            $manager->flush();
            $this->loginUserAutomatically($user, $passwordCrypte);
            $this->addFlash('success', "Bienvenue parmis nous");
            return $this->redirectToRoute('my_profile');
        }
        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function loginUserAutomatically($user, $password)
    {
        $token = new UsernamePasswordToken(
            $user,
            $password,
            'main', // security.yaml
            $user->getRoles()
        );
        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('_security_main', serialize($token));
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $util)
    {
        $error = $util->getLastAuthenticationError();
        return $this->render('user/login.html.twig', [
            'lastUserName' => $util->getLastUsername(),
            'error' => $error !== null,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \Exception('This should never be reached!');
    }

    /**
     * @Route("/myProfile", name="my_profile")
     */
    public function myProfile()
    {
        return $this->render('user/myProfile.html.twig');
    }
}
