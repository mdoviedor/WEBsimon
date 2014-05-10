<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ErroresController extends Controller {

    public function AlertageneralAction() {
        return $this->render('GSContenidosBundle:Errores:Alertageneral.html.twig');
    }

}
