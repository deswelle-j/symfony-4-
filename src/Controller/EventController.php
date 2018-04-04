<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    private $events;
    public function __construct(){
        $this->events = array(
            array(
                'id' => '0',
                'title'   => 'Black cat event',
                'content' => 'Loremp ipsum ........',
                'startAt' => new \DateTime('2018-03-12 5:08am'),
                'shouldEndAt' => new \DateTime('2018-03-12 6:30am'),
                'place' => '44 rue scrive 59110 La Madeleine',
            ),
            array(
                'id' => '1',
                'title'   => 'Still alive yet',
                'content' => 'Lolorem ipsoum .....',
                'startAt' => new \DateTime('2018-05-21 8:30am'),
                'shouldEndAt' => new \DateTime('2018-05-21 9:30am'),
                'place' => '34 de la corniche',
            ),
        );
    }
    
    public function List(){
        return $this->render('event/list.html.twig', array(
        'events' => $this->events));
    }

    public function show($id){
        foreach( $this->events as $event ){
            if( $event['id'] == $id){
                return $this->render('event/show.html.twig', array(
                    'event' => $event));
            }
        }
        return new Response ('Erreur Not Found', 404);
    }

    public function add(){
        return new Response(' Add event');
    }

    public function join(){
        return new Response(' Join event');
    }
}
