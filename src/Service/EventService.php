<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\EventRepository;

class EventService{
    private $om;
    private $eventRepository;

    public function __construct( ObjectManager $om){
        $this->om = $om;
        $this->eventRepository =  $this->om->getRepository( 'App:Event' );

    }

    public function events( $sort = null ){
        // $eventRepository = $this->om->getRepository( 'App:Event' );
        if( $sort == 'name'){
            return $this->eventRepository->findBy( array( ), array('name' => 'ASC'));
        }elseif( $sort == 'date'){
            return $this->eventRepository->findBy( array(), array('date' => 'ASC'));
        }
        return $this->eventRepository->findAll();
    }

    public function event( $id ){
        // $eventRepository = $this->om->getRepository( 'App:Event' );
        return $this->eventRepository->findOneBy( array( 'id' => $id ));
    }

    public function getEventByName( $name ){
        // $eventRepository = $this->om->getRepository( 'App:Event' );
        return $this->eventRepository->findBy( array( 'name' => $name));
    }
    public function countPendding(){
        return $this->eventRepository->countPendding();
    }

    public function search( $term ){
        return $this->eventRepository->search( $term );
    }

}