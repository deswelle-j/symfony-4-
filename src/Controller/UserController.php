<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SubscribeType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    public function subscribe( Request $request ,UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();
        $roles[]='ROLE_USER';
        $user->setRoles($roles);
        $form = $this->createForm( SubscribeType::class, $user );
        $form->handleRequest( $request);
        if ($form->isSubmitted() && $form->isValid()){

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist( $user );
            $em->flush();

            $this->addFlash('notice', 'Vous avez bien été ajouté');

            return $this->redirectToRoute('events');
        }
        return $this->render('user/subscribe.html.twig', array( 'form' => $form->createView() ));
    }
}
