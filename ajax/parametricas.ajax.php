<?php

require_once "../controladores/parametricas.controlador.php";
require_once "../modelos/parametricas.modelo.php";

class AjaxParametricas{

    /*==============================
    OBTENER LAS CIUDADES DEL DEPARTAMENTO
    ===============================*/
    public $idDepartamento;

    public function ajaxObtenerCiudadesDepartamento(){

        $valor = $this->idDepartamento;

        $ciudades = ControladorParametricas::ctrObtenerCiudadesDepartamento($valor);

        $cadena = '';

        $cadena .= '<div class="col-lg-6">
                        <label>Ciudad Residencia:</label>        
                        <div class="input-group">
                            <select class="form-control" name="nuevaCiudadResidencia" required>
                            <option value="">-- Seleccione una opcion --</option>';

                            foreach($ciudades as $keyCiudades => $valueCiudades){

                                $cadena .= '<option value="'.$valueCiudades["cod_ciudad"].'">'.$valueCiudades["ciudad"].'</option>';

                            }

                $cadena .= '</select>
                            <span class="input-group-addon">
                                <i class="fas fa-star"></i>
                            </span>
                        </div>
                    </div>';
        
        echo $cadena;

    }

    /*==============================
    TRAER DATOS TIPO IDENTIFICACION
    ===============================*/
    public $tipoIdentificacion;

    public function ajaxTraerTipoIdentificacion(){

        $tabla = "par_tipo_documento";
        $item = "id_tipo_doc";
        $valor = $this->tipoIdentificacion;

        $tipoDocumento = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($tipoDocumento);

    }

    /*==========================
    TRAER DATOS NACIONALIDAD
    ===========================*/
    public $nacionalidad;

    public function ajaxTraerNacionalidad(){

        $tabla = "par_pais";
        $item = "cod_pais";
        $valor = $this->nacionalidad;

        $nacionalidad = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($nacionalidad);

    }

    /*=======================
    TRAER DATOS DEPARTAMENTOS
    ========================*/
    public $departamento;

    public function ajaxTraerDepartamento(){

        $tabla ="par_ciudades";
        $item = "cod_dep";
        $valor = $this->departamento;

        $departamento = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($departamento);

    }

    /*====================
    TRAER DATOS DE SECTOR
    =====================*/
    public $idSector;

    public function ajaxTraerSector(){

        $tabla = "par_sectores";
        $item = "id_sector";
        $valor = $this->idSector;

        $sector = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($sector);

    }

    /*============================
    TRAER INSTITUCIONES CON ESE DEPARTAMENTO
    =============================*/
    public $idDepartamentoInstitucion;

    public function ajaxTraerInstitucionDepartamento(){

        $item = "ciudad";
        $valor = $this->idDepartamentoInstitucion;

        $cadena = '';

        if($valor == "OTRO"){

            $cadena .= '
                <label>Institución Educativa:</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="nuevaInstitucionEducativaOtro" onkeyup="mayusculas(this)" required>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>';

        }else{

            $cadena .= '
                <label>Institución Educativa:</label>
                <div class="input-group">
                    <select class="form-control" name="nuevaInstitucionEducativa" required>
                        <option value="">-- Seleccione una opcion --</option>';
                        

            $institucionesDep = ControladorParametricas::ctrObtenerInstitucionesDepartamentos($item, $valor);

            foreach($institucionesDep as $key => $institucionesDepValue){

                $cadena .= '<option value="'.$institucionesDepValue["id_institucion"].'">'.$institucionesDepValue["nombre"].'</option>';

            }

            $cadena .= '
                    </select>
                    <span class="input-group-addon">
                        <i class="fa fa-star"></i>
                    </span>
                </div>';


        }


        echo $cadena;

    }


    /*============================
    TRAER NIVEL EDUCATIVO
    =============================*/
    public $idNivelEducativo;

    public function ajaxMostrarNivelEducativo(){

        $item = "id_nivel";
        $valor = $this->idNivelEducativo;

        $nivelesEducativos = ControladorParametricas::ctrObtenerNivelesEstudios($item, $valor);

        echo json_encode($nivelesEducativos);

    }

}


/*==============================
OBTENER LAS CIUDADES DEL DEPARTAMENTO
===============================*/
if(isset($_POST["idDepartamento"])){

    $ciudadVal = new AjaxParametricas();
    $ciudadVal->idDepartamento = $_POST["idDepartamento"];
    $ciudadVal->ajaxObtenerCiudadesDepartamento();

}

/*==============================
TRAER DATOS TIPO IDENTIFICACION
===============================*/
if(isset($_POST["tipoIdentificacion"])){

    $tIdentificacion = new AjaxParametricas();
    $tIdentificacion->tipoIdentificacion = $_POST["tipoIdentificacion"];
    $tIdentificacion->ajaxTraerTipoIdentificacion();

}

/*==========================
TRAER DATOS NACIONALIDAD
===========================*/
if(isset($_POST["nacionalidad"])){

    $datosNacionalidad = new AjaxParametricas();
    $datosNacionalidad->nacionalidad = $_POST["nacionalidad"];
    $datosNacionalidad->ajaxTraerNacionalidad();

}

/*=======================
TRAER DATOS DEPARTAMENTOS
========================*/
if(isset($_POST["departamentoResidencia"])){

    $datosDepartamento = new AjaxParametricas();
    $datosDepartamento->departamento = $_POST["departamentoResidencia"];
    $datosDepartamento->ajaxTraerDepartamento();

}

/*===================
TRAER DATOS DE SECTOR
=====================*/
if(isset($_POST["idSector"])){

    $traerSector = new AjaxParametricas();
    $traerSector->idSector = $_POST["idSector"];
    $traerSector->ajaxTraerSector();

}

/*============================
TRAER INSTITUCIONES CON ESE DEPARTAMENTO
=============================*/
if(isset($_POST["idDepartamentoInstitucion"])){

    $departamentoIns = new AjaxParametricas();
    $departamentoIns->idDepartamentoInstitucion = $_POST["idDepartamentoInstitucion"];
    $departamentoIns->ajaxTraerInstitucionDepartamento();

}

/*============================
TRAER NIVEL EDUCATIVO
=============================*/
if(isset($_POST["idNivelEducativo"])){

    $nivelEstudio = new AjaxParametricas();
    $nivelEstudio->idNivelEducativo = $_POST["idNivelEducativo"];
    $nivelEstudio->ajaxMostrarNivelEducativo();

}