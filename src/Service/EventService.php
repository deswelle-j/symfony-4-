<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class EventService{
    private $events;
    private $om;

    public function __construct( ObjectManager $om ){
        $this->om = $om;
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

    public function events( ){
        $eventRepository = $this->om->getRepository( 'App:Event' );
        return $eventRepository->findAll();
    }

    public function event($id){
        $eventRepository = $this->om->getRepository( 'App:Event' );
        return $eventRepository->findOneBy( array( 'id' => $id));
        // foreach( $this->events as $event ){
        //     if( $event['id'] == $id){
        //         return $event;
        //     }
        // }
        // return false;
    }

    public function getEventByName( $name ){
        $eventRepository = $this->om->getRepository( 'App:Event' );
        return $eventRepository->findBy( array( 'name' => $name));
    }

}