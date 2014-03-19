<?php

namespace GS\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GSUsuarioBundle:Default:index.html.twig', array('name' => $name));
    }
}
