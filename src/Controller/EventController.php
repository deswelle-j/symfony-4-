<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * @Route("/event", name="event")
     */
    public function List(){
        return $this->render('event/list.html.twig', array(
            'events' => array(
                'event1' => array(
                    'title'   => 'Black cat event',
                    'content' => 'Loremp ipsum ........',
                    
                ),
                'event2' => array(
                    'title'   => 'Still alive yet',
                    'content' => 'Lolorem ipsoum .....',
                ),
            ),
        ));
    }

    public function show($id){
        $title = 'Nom de l\'evenement';
        $content = 'Description de l\'evenement en question';
        return $this->render('event/show.html.twig', array(
            'event' => array(
                'title'   => $title,
                'content' => $content,
            ),

        ));
    }

    public function add(){
        return new Response(' Add event');
    }

    public function join(){
        return new Response(' Join event');
    }
}
