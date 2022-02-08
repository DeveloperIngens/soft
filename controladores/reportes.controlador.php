<?php

class ControladorReportes{

    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO ESTADO DE CONDICION
    ===================================*/
    static public function ctrObtenerEquiposEstadoCondicion(){

        $tabla = "tecnologia";

        $respuesta = ModeloReportes::mdlObtenerEquiposEstadoCondicion($tabla);

        return $respuesta;

    }


    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO COMPUTADORES PANTALLA PORTATIL
    ===================================*/
    static public function ctrObtenerEquiposPcDatos(){

        $tabla1 = "tecnologia";
        $tabla2 = "par_categoria";

        $respuesta = ModeloReportes::mdlObtenerEquiposPcDatos($tabla1, $tabla2);

        return $respuesta;

    }


    /*==================================
    OBTENER EQUIPOS PROPIOS O ARRENDADO
    ===================================*/
    static public function ctrObtenerEquiposPropiosArrendados(){

        $tabla = "tecnologia";

        $respuesta = ModeloReportes::mdlObtenerEquiposPropiosArrendados($tabla);

        return $respuesta;

    }

    /*==================================
    OBTENER PROPIOS Y RENTADOS POR CATEGORIA
    ===================================*/   
    static public function ctrObtenerPropiosRentadosCategoria(){

        $tabla1 = "tecnologia";
        $tabla2 = "par_categoria";

        $respuesta = ModeloReportes::mdlObtenerPropiosRentadosCategoria($tabla1, $tabla2);

        return $respuesta;

    } 

}