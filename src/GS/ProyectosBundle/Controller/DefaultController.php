<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GSProyectosBundle:Default:index.html.twig', array('name' => $name));
    }
}
