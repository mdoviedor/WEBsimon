<?php

namespace GS\ConsultasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GSConsultasBundle:Default:index.html.twig', array('name' => $name));
    }
}
