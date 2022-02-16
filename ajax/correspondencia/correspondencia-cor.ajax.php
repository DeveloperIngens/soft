<?php

require_once "../../controladores/correspondencia/correspondencia-cor.controlador.php";
require_once "../../modelos/correspondencia/correspondencia-cor.modelo.php";

class AjaxCorrespondencia {

    /*================================
    OBTENER CODIGO CONCECUTIVO
    ================================*/
    public $idProyecto;

    public function ajaxObtenerCodigoConcecutivo(){

        $tabla = "proyectos_cor";
        $idProyecto = $this->idProyecto;

        $codigoConcecutivo = ControladorCorrespondencia::ctrObtenerCodigoConcecutivo($tabla, $idProyecto);

        if($codigoConcecutivo["numero_concecutivo"] != ""){

            $concecutioConCeros = substr(str_repeat(0, 4).($codigoConcecutivo["numero_concecutivo"] + 1), - 4);

            $concecutivo = $codigoConcecutivo["prefijo_proyecto"]  . "-" . $concecutioConCeros;

            echo '<div class="form-group">
                    <input type="hidden" value="'.$codigoConcecutivo["prefijo_proyecto"].'" name="nuevoPrefijoProyecto">
                </div>';

        }else{

            echo '<div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-warning"></i> Error!</h4>
                    El Proyecto no tiene concecutivo, por favor volver a intentarlo!
                </div>';

        }

    }

    /*================================
    MOSTRAR INFO DE CARGAR DOCUMENTO RADICAR
    ================================*/
    public $idCorrespondenciaEnviada;

    public function ajaxInformacionCargarRadicacion(){

        $tabla = "correspondencia_enviada";
        $item = "id_cor_enviado";
        $valor = $this->idCorrespondenciaEnviada;

        $respuesta = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

    /*================================
    VER CORRESPONDENCIA RECIBIDA
    ================================*/
    public $idCorrespondenciaRecibida;

    public function ajaxObtenerInformacionCorrespondenciaRecibida(){

        $tabla = "correspondencia_recibida";
        $item = "id_cor_recibida";
        $valor = $this->idCorrespondenciaRecibida;

        $respuesta = ControladorCorrespondencia::ctrMostrarCorrespondenciaRequerida($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

    /*===========================
    ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA
    ============================*/
    public $idCorrespondenciaRecibidaAceptada;

    public function ajaxAceptarCorrespondenciaRecibida(){

        $tabla = "correspondencia_recibida";
        $item = "id_cor_recibida";
        $valor = $this->idCorrespondenciaRecibidaAceptada;

        $respuesta = ModeloCorrespondencia::mdlAceptarCorrespondenciaRecibida($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

    /*===========================
    ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNADA
    ============================*/
    public $idCorrespondenciaRecibidaAceptaReAsign;
    public $idUsuarioAcepta;

    public function ajaxAceptarCorrespondenciaRecibidaReAsign(){

        $tabla = "correspondencia_recibida";
        $item = "id_cor_recibida";
        $valor = $this->idCorrespondenciaRecibidaAceptaReAsign;
        $idUsuario = $this->idUsuarioAcepta;

        $respuesta = ModeloCorrespondencia::mdlAceptarCorrespondenciaRecibidaReAsign($tabla, $item, $valor, $idUsuario);

        echo json_encode($respuesta);

    }

    /*===========================
    RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA
    ============================*/
    /*
    public $idCorrespondenciaRecibidaRechaza;

    public function ajaxRechazarCorrespondenciaRecibida(){

        $tabla = "correspondencia_recibida";
        $item = "id_cor_recibida";
        $valor = $this->idCorrespondenciaRecibidaRechaza;

        $respuesta = ModeloCorrespondencia::mdlRechazarCorrespondenciaRecibida($tabla, $item, $valor);

        echo json_encode($respuesta);

    }
    */

}


/*================================
OBTENER CODIGO CONCECUTIVO
================================*/
if(isset($_POST["idProyecto"])){

    $obtConcecutivo = new AjaxCorrespondencia();
    $obtConcecutivo->idProyecto = $_POST["idProyecto"];
    $obtConcecutivo->ajaxObtenerCodigoConcecutivo();

}

/*================================
MOSTRAR INFO DE CARGAR DOCUMENTO RADICAR
================================*/
if(isset($_POST["idCorrespondenciaEnviada"])){

    $cargarDocRad = new AjaxCorrespondencia();
    $cargarDocRad->idCorrespondenciaEnviada = $_POST["idCorrespondenciaEnviada"];
    $cargarDocRad->ajaxInformacionCargarRadicacion();

}

/*================================
VER CORRESPONDENCIA RECIBIDA
================================*/
if(isset($_POST["idCorrespondenciaRecibida"])){

    $verCorRec = new AjaxCorrespondencia();
    $verCorRec->idCorrespondenciaRecibida = $_POST["idCorrespondenciaRecibida"];
    $verCorRec->ajaxObtenerInformacionCorrespondenciaRecibida();

}

/*===========================
ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA
============================*/
if(isset($_POST["idCorrespondenciaRecibidaAcepta"])){

    $aceptarCorRec = new AjaxCorrespondencia();
    $aceptarCorRec->idCorrespondenciaRecibidaAceptada = $_POST["idCorrespondenciaRecibidaAcepta"];
    $aceptarCorRec->ajaxAceptarCorrespondenciaRecibida();

}

/*===========================
ACEPTAR ASIGNACION CORRESPONDENCIA RECIBIDA RE-ASIGNADA
============================*/
if(isset($_POST["idCorrespondenciaRecibidaAceptaReAsign"])){

    $aceptarCorRecReAsig = new AjaxCorrespondencia();
    $aceptarCorRecReAsig->idCorrespondenciaRecibidaAceptaReAsign = $_POST["idCorrespondenciaRecibidaAceptaReAsign"];
    $aceptarCorRecReAsig->idUsuarioAcepta = $_POST["idUsuarioAcepta"];
    $aceptarCorRecReAsig->ajaxAceptarCorrespondenciaRecibidaReAsign();

}

/*===========================
RECHAZAR ASIGNACION CORRESPONDENCIA RECIBIDA
============================*/
/*
if(isset($_POST["idCorrespondenciaRecibidaRechaza"])){

    $rechazarCorRec = new AjaxCorrespondencia();
    $rechazarCorRec->idCorrespondenciaRecibidaRechaza = $_POST["idCorrespondenciaRecibidaRechaza"];
    $rechazarCorRec->ajaxRechazarCorrespondenciaRecibida();

}
*/