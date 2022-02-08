<?php

require_once "../../controladores/correspondencia/parametricas-cor.controlador.php";
require_once "../../modelos/correspondencia/parametricas-cor.modelo.php";

class AjaxProyectos {

    /*====================================
    VALIDAR SI EXISTE PREFIJO
    ====================================*/
    public $valorPrefijo;

    public function ajaxValidarPrefijo(){

        $tabla = "proyectos_cor";
        $item = "prefijo_proyecto";
        $valor = $this->valorPrefijo;

        $datoPerfijo = ControladorParametricasCor::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($datoPerfijo);

    }


    /*====================================
    EDITAR PROYECTO
    ====================================*/
    public $idProyecto;

    public function ajaxEditarProyecto(){

        $tabla = "proyectos_cor";
        $item = "id_proyecto";
        $valor = $this->idProyecto;

        $respuesta = ControladorParametricasCor::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

}

/*====================================
VALIDAR SI EXISTE PREFIJO
====================================*/
if(isset($_POST["validarPrefijo"])){

    $validarPrefijo = new AjaxProyectos();
    $validarPrefijo->valorPrefijo = $_POST["validarPrefijo"];
    $validarPrefijo->ajaxValidarPrefijo();

}

/*====================================
EDITAR PROYECTO
====================================*/
if(isset($_POST["idProyecto"])){

    $editarPro = new AjaxProyectos();
    $editarPro->idProyecto = $_POST["idProyecto"];
    $editarPro->ajaxEditarProyecto();

}
