<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function __construct(){
        return $events = array(
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
        'events' => $this->__construct()));
    }

    public function show($id){
        $title = 'Nom de l\'evenement';
        $content = 'Description de l\'evenement en question';
        return $this->render('event/show.html.twig', array(
            'event' => $this->__construct()[$id]));
    }

    public function add(){
        return new Response(' Add event');
    }

    public function join(){
        return new Response(' Join event');
    }
}
