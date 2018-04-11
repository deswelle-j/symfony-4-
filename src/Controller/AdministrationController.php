<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Service\AdministrationService;
use App\Form\AddPlaceType;
use App\Entity\Place;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends Controller
{

    public function administration( AdministrationService $adminService, Request $request )
    {
        $place = new Place();
        $formplace = $this->createForm( AddPlaceType::class, $place );
        $formplace->handleRequest( $request);
        if ($formplace->isSubmitted() && $formplace->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist( $place );
            $em->flush();

            $this->addFlash('notice', 'Votre option à bien été ajoutée');

            return $this->redirectToRoute('administration', array( 
            ));
        }





        $options = $adminService->options();
        $places = $adminService->places();
        $typeplaces = $adminService->typlePlaces();
        return $this->render('administration/index.html.twig', array(
            'formplace' => $formplace->createView(),
            'options' => $options,
            'places'  => $places,
            'typeplaces' => $typeplaces,
        ));
    }
}
