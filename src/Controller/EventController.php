<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EventService;
use App\Entity\Event;
use App\Form\AddEventType;


class EventController extends Controller
{

    public function list( EventService $eventService, Request $request){
        $sort = $request->query->get('sort');
        $search = $request->query->get('search');

        if(empty( $search )){
            $items = $eventService->events( $sort );
        }else{
            $items = $eventService->search( $search );
        }

        return $this->render('event/list.html.twig', array(
        'events' =>$items,
        'counter' => $eventService->countPendding()
    ));
    }

    public function show( EventService $eventService ,$id ){
        if($eventService->event($id) === false){
            return new Response ('Erreur Not Found', 404);
        }
        return $this->render('event/show.html.twig', array(
            'event' => $eventService->event($id)));

    }

    public function add( Request $request){
        $event = new Event();
        $form = $this->createForm( AddEventType::class, $event );
        $form->handleRequest( $request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist( $event );
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('event/add.html.twig', array( 'form' => $form->createView() ));
    }

    public function join(){
        return new Response(' Join event');
    }
}
