<?php

namespace App\Service;

class EventService{


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

    public function events(){
        return $this->events;
    }

    public function event($id){
        foreach( $this->events as $event ){
            if( $event['id'] == $id){
                return $event;
            }
        }
        return new Response ('Erreur Not Found', 404);
    }

}