<?php

namespace GS\SemilleroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GSSemilleroBundle:Default:index.html.twig', array('name' => $name));
    }
}
