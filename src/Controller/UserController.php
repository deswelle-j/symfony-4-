<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function login( AuthenticationUtils $authentificationUtils )
    {
        return $this->render('user/login.html.twig', array(
            'lastUsername' => $authentificationUtils->getLastUsername(),
            'error' =>$authentificationUtils->getLAstAuthenticationError(),
        ));
    }
}
