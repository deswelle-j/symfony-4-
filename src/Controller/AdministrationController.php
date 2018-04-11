<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Service\AdministrationService;
use App\Form\AddPlaceType;
use App\Entity\Place;

use App\Form\AddOptionType;
use App\Entity\Option;

use App\Form\addTypePlaceType;
use App\Entity\TypePlace;

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

            $this->addFlash('notice', 'Votre lieu à bien été ajoutée');

            return $this->redirectToRoute('administration', array( 
            ));
        }

        $noption = new Option();
        $formoption = $this->createForm( AddOptionType::class, $noption );
        $formoption->handleRequest( $request);
        if ($formoption->isSubmitted() && $formoption->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist( $noption );
            $em->flush();

            $this->addFlash('notice', 'Votre option à bien été ajoutée');

            return $this->redirectToRoute('administration', array( 
            ));
        }

        $type = new TypePlace();
        $formtype = $this->createForm( addTypePlaceType::class, $type );
        $formtype->handleRequest( $request);
        if ($formtype->isSubmitted() && $formtype->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist( $type );
            $em->flush();

            $this->addFlash('notice', 'Votre Type de lieu à bien été ajouté');

            return $this->redirectToRoute('administration', array( 
            ));
        }

        $options = $adminService->options();
        $places = $adminService->places();
        $typeplaces = $adminService->typlePlaces();
        return $this->render('administration/index.html.twig', array(
            'formplace' => $formplace->createView(),
            'formoption' => $formoption->createView(),
            'formtype' => $formtype->createView(),
            'options' => $options,
            'places'  => $places,
            'typeplaces' => $typeplaces,
        ));
    }
}
