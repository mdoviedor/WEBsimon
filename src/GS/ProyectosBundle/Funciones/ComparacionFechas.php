<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GS\ProyectosBundle\Funciones;

/**
 * Description of ComparacionFechas
 * Clase usada para compara las fechas del cronograma vs la fecha actual. 
 * @author Marlon
 */
class ComparacionFechas {
    
    /*
     * Retorna la diferencia en días de las fechas del cronograma vs la fecha actual
     */
    function interval_date2($finish) {
        $final = (string) $finish->format('y-m-d');
        $segundos = strtotime($final) - strtotime('now');
        $diferencia_dias = intval($segundos / 60 / 60 / 24);
        return $diferencia_dias;
    }

    /*
     * Retorna el porcentaje restante para que culmine la actividad propuesta en 
     * el cronograma. 
     */
    function porcentaje($dias) {
        $porcentaje = (($dias * 100) / 20);
        return 100-$porcentaje;
    }

}
