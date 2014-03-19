<?php

namespace GS\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GSInventarioBundle:Default:index.html.twig', array('name' => $name));
    }
}
