<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Service\EventService;

class EventController extends Controller
{
    
    public function list( EventService $eventService ){
        return $this->render('event/list.html.twig', array(
        'events' => $eventService->events()));
    }

    public function show( EventService $eventService ,$id){
        if($eventService->event($id) === false){
            return new Response ('Erreur Not Found', 404);
        }
        return $this->render('event/show.html.twig', array(
            'event' => $eventService->event($id)));

    }

    public function add(){
        return new Response(' Add event');
    }

    public function join(){
        return new Response(' Join event');
    }
}
