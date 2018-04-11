<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\OptionRepository;
use App\Repository\PlaceRepository;
use App\Repository\TypePlaceRepository;



class AdministrationService{
    private $om;
    private $OptionRepository;
    private $PlaceRepository;
    private $TypePlaceRepository;

    public function __construct( ObjectManager $om){
        $this->om = $om;
        $this->OptionRepository =  $this->om->getRepository( 'App:Option' );
        $this->PlaceRepository =  $this->om->getRepository( 'App:Place' );
        $this->TypePlaceRepository =  $this->om->getRepository( 'App:TypePlace' );
    }

    public function options( ){
        // $eventRepository = $this->om->getRepository( 'App:Event' );
        return $this->OptionRepository->findAll();
    }

    public function places( ){
        // $eventRepository = $this->om->getRepository( 'App:Event' );
        return $this->PlaceRepository->findAll( );
    }

    public function typlePlaces( ){
        // $eventRepository = $this->om->getRepository( 'App:Event' );
        return $this->TypePlaceRepository->findAll();
    }
}