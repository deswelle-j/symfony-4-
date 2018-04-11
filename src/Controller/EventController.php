<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\EventService;
use App\Entity\Event;
use App\Form\AddEventType;
use App\Form\AddParticipantType;
use App\Form\ReviewType;
use App\Entity\Participant;
use App\Entity\Review;



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

            $this->addFlash('notice', 'Votre évenement à bien été ajouté');

            return $this->redirectToRoute('event', array(
                'id' => $event->getId(),
            ));
        }
        return $this->render('event/addEvent.html.twig', array( 'form' => $form->createView() ));
    }

    public function join( EventService $eventService ,Request $request, $id ){
        $participant = new Participant();
        $event = $eventService->event($id);

        $participant->setEvent($event);
        $participant->setUser( $this->getUser());
        $participant->setName($this->getUSer()->getUserName());

        $form = $this->createForm( AddParticipantType::class, $participant );
        $form->handleRequest( $request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist( $participant );
            $em->flush();

            $this->addFlash('notice', 'Votre participant à bien été ajouté');

            return $this->redirectToRoute('event', array(
                'id' => $event->getId(),
            ));
        }
        return $this->render('event/addParticipant.html.twig', array( 'form' => $form->createView() ));
    }


public function review(Request $request, Event $event ){
    $review = new Review();
    $participantRepository = $this->getDoctrine()->getRepository('App:Participant');
    $participant = $participantRepository->findOneBy( array(
        'user' => $this->getUser(),
        'event' => $event,
    ));

    $review->setReviewer($participant);
    $review->setEvent($event);
    
    // $participant->setName($this->getUSer()->getUserName());
    $form = $this->createForm( ReviewType::class, $review );
    $form->handleRequest( $request);
    if ($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist( $review );
        $em->flush();

        $this->addFlash('notice', 'Votre avis à bien été ajouté');

        return $this->redirectToRoute('event', array(
            'id' => $event->getId(),
        ));
    }
    return $this->render('event/addReview.html.twig', array( 'form' => $form->createView() ));
}
}