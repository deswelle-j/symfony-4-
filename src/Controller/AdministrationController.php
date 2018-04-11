<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{

    public function administration()
    {
        return $this->render('administration/index.html.twig', array());
    }
}
