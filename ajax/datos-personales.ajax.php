<?php

require_once "../controladores/hoja-vida.controlador.php";
require_once "../modelos/hoja-vida.modelo.php";

class AjaxDatosPersonales{

    /*===============================
    VALIDAR SI EL USUARIO YA TIENE DATOS PERSONALES
    ================================*/
    public $identificacionPersona;
    
    public function ajaxValidarDatosPersonales(){

        $valor = $this->identificacionPersona;

        $respuesta = ControladorHojaVida::ctrValidarExisteHojaVidaDocumento($valor);

        echo json_encode($respuesta);

    }


    /*===============================
    TRAER DATOS PERSONALES
    ================================*/
    public $idDatosPersonales;
    
    public function ajaxTraerDatosPersonales(){

        $item = "id_datos_personales";
        $valor = $this->idDatosPersonales;

        $respuesta = ControladorHojaVida::ctrTraerDatosPersonales($item, $valor);

        echo json_encode($respuesta);

    }

}

/*===============================
VALIDAR SI EL USUARIO YA TIENE DATOS PERSONALES
================================*/
if(isset($_POST["identificacionPersona"])){

    $validar = new AjaxDatosPersonales();
    $validar->identificacionPersona = $_POST["identificacionPersona"];
    $validar->ajaxValidarDatosPersonales();

}

/*===============================
TRAER DATOS PERSONALES
================================*/
if(isset($_POST["idDatosPersonales"])){

    $traerDatosPersonales = new AjaxDatosPersonales();
    $traerDatosPersonales->idDatosPersonales = $_POST["idDatosPersonales"];
    $traerDatosPersonales->ajaxTraerDatosPersonales();

}

