<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GS\ProyectosBundle\Funciones;

/**
 * Description of IdentificadorFecha
 *
 * @author Marlon
 */
class IdentificadorFecha {

    private $ano; //Tomar año actual

    function __construct() {
        $this->ano = date('Y');
    }

    /*
     * Crear consecutivo de claves primarias segun el año. ESTUDIANTEENF
     */

    public function generarIdTemaUsuario($ultimoRegistro) {
        if ($ultimoRegistro != null && $ultimoRegistro != "") {//Si no existe ningun registro previo en la base de datos
            $variable = $ultimoRegistro[0]['idtemaUsuario']; //Se pasa el valor del array
            $ano = substr($variable, 0, 4); //Se separa el año del array
            if ($ano == $this->ano) {
                $consecutivo = $variable + 1; //Se suma uno al id
                return $consecutivo;
            } else {
                return $this->ano . '000000'; //Si ha cambiado el año, empieza el consecutivo nuevamente en cero
            }
        } else {
            return $this->ano . '000000'; //Registro inicial
        }
    }

    public function generarIdEspacioTrabajo($ultimoRegistro) {
        if ($ultimoRegistro != null && $ultimoRegistro != "") {//Si no existe ningun registro previo en la base de datos
            $variable = $ultimoRegistro[0]['idespaciotrabajo']; //Se pasa el valor del array
            $ano = substr($variable, 0, 4); //Se separa el año del array
            if ($ano == $this->ano) {
                $consecutivo = $variable + 1; //Se suma uno al id
                return $consecutivo;
            } else {
                return $this->ano . '000000'; //Si ha cambiado el año, empieza el consecutivo nuevamente en cero
            }
        } else {
            return $this->ano . '000000'; //Registro inicial
        }
    }
    
    public function generarIdProduccionIntelectual($ultimoRegistro) {
        if ($ultimoRegistro != null && $ultimoRegistro != "") {//Si no existe ningun registro previo en la base de datos
            $variable = $ultimoRegistro[0]['idproduccionintelectual']; //Se pasa el valor del array
            $ano = substr($variable, 0, 4); //Se separa el año del array
            if ($ano == $this->ano) {
                $consecutivo = $variable + 1; //Se suma uno al id
                return $consecutivo;
            } else {
                return $this->ano . '000000'; //Si ha cambiado el año, empieza el consecutivo nuevamente en cero
            }
        } else {
            return $this->ano . '000000'; //Registro inicial
        }
    }

}
