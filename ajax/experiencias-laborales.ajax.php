<?php

require_once "../controladores/hoja-vida.controlador.php";
require_once "../modelos/hoja-vida.modelo.php";
require_once "../controladores/parametricas.controlador.php";
require_once "../modelos/parametricas.modelo.php";

class AjaxExperienciasLaborales{

    /*===========================
    VER EXPERIENCIA LABORAL
    =============================*/
    public $idExperienciaLaboralVer;

    public function ajaxVerInformacionExperienciaLaboral(){

        $item = "id_experiencia_laboral";
        $valor = $this->idExperienciaLaboralVer;

        $respuesta = ControladorHojaVida::ctrMostrarExperienciasLaboralesVer($item, $valor);

        echo json_encode($respuesta);

    }

    /*===========================
    EDITAR EXPERIENCIA LABORAL
    =============================*/
    public $idEditarExperienciaLaboral;

    public function ajaxEditarInformacionExperienciaLaboral(){

        $item = "id_experiencia_laboral";
        $valor = $this->idEditarExperienciaLaboral;

        $respuesta = ControladorHojaVida::ctrMostrarExperienciasLaboralesVer($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================
    TRAER TODAS LAS EXPERIENCIAS LABORALES DE LA PERSONA
    =============================*/
    public $idIdentificacionPersona;

    public function ajaxTraerExperienciasPersona(){

        $item = "identificacion_fk";
        $valor = $this->idIdentificacionPersona;

        $experienciaLaboral = ControladorHojaVida::ctrTraerExperienciasPersona($item, $valor);

        $cadenaExperienciaL = "";

        $totalExperiencia = ControladorHojaVida::ctrCalcularExperienciaTotal($valor);

        $cadenaExperienciaL .= '<center><h5>Tiempo Laborado en Años: <b>'.$totalExperiencia["tiempo_anios"].'</b> - Tiempo Laborado en Meses: <b>'.$totalExperiencia["tiempo_meses"].'</b></h5></center><hr>';

        foreach($experienciaLaboral as $key => $valueExperienciaLaboral){

            $tablaSector = "par_sectores";

            $itemSector = "id_sector";
            $valorSector = $valueExperienciaLaboral["sector_id"]; 

            $sector = ControladorParametricas::ctrObtenerDatoRequerido($tablaSector, $itemSector, $valorSector);


            $cadenaExperienciaL .= '<div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Experiencia Laboral: <b>'.$valueExperienciaLaboral["empresa_entidad"].'</b></h3>
                    <hr>
                </div>
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Empresa o Entidad Contratante:</label> '.$valueExperienciaLaboral["empresa_entidad"].'

                            </div>
                        
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Cargo Desempeñado:</label> '.$valueExperienciaLaboral["cargo"].'
                        
                            </div>
                        
                        </div>

                    </div>

                    <div class="row">';

                        if(!empty($sector)){

                        $cadenaExperienciaL .= '<div class="col-md-4">

                                <div class="form-group">

                                    <label>Sector:</label> '.$sector["nombre"].'

                                </div>
                        
                            </div>';

                        }

                        if($valueExperienciaLaboral["area_trabajo"] != ""){

                            $cadenaExperienciaL .= '<div class="col-md-4">

                                <div class="form-group">

                                    <label>Área de Trabajo:</label> '.$valueExperienciaLaboral["area_trabajo"].'

                                </div>
                                
                            </div>';

                        }

                        if($valueExperienciaLaboral["valor_contrato_salario"] != ""){

                            $cadenaExperienciaL .= '<div class="col-md-4">

                                <div class="form-group">

                                    <label>Valor Contrato y/o Salario:</label> '.$valueExperienciaLaboral["valor_contrato_salario"].'

                                </div>
                                
                            </div>';

                        }

                        $cadenaExperienciaL .= '</div>';

                        $cadenaExperienciaL .= '<div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Fecha Inicio de Labor:</label> '.$valueExperienciaLaboral["fecha_inicio"].'

                                </div>
                            
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Fecha Fin de Labor:</label> '.$valueExperienciaLaboral["fecha_fin"].'

                                </div>
                            
                            </div>
                        
                        </div>';

                        $cadenaExperienciaL .= '<div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Tiempo Laborado en Dias:</label> '.$valueExperienciaLaboral["tiempo_dias"].'

                                </div>
                            
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    
                                    <label>Tiempo Laborado en Meses:</label> '.$valueExperienciaLaboral["tiempo_meses"].'
                                
                                </div>
                            
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Tiempo Laborado en Años:</label> '.$valueExperienciaLaboral["tiempo_anios"].'

                                </div>
                            
                            </div>
                        
                        </div>';


                        $cadenaExperienciaL .= '<div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Tipo de Documento:</label> '.$valueExperienciaLaboral["tipo_documento"].'

                                </div>
                            
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Adjunto Certificación:</label> <a href="'.$valueExperienciaLaboral["adjunto_certificacion"].'" target="_blank">Archivo Adjunto</a>

                                </div>
                            
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Certificado con funciones:</label> '.$valueExperienciaLaboral["objeto_contrato"].'

                                </div>
                            
                            </div>
                        
                        
                        </div>';

                $cadenaExperienciaL .= '</div>
                
            </div>';

        }

        echo $cadenaExperienciaL;

    }


}

/*===========================
VER EXPERIENCIA LABORAL
=============================*/
if(isset($_POST["idExperienciaLaboralVer"])){

    $ejecutar = new AjaxExperienciasLaborales();
    $ejecutar->idExperienciaLaboralVer = $_POST["idExperienciaLaboralVer"];
    $ejecutar->ajaxVerInformacionExperienciaLaboral();

}

/*===========================
EDITAR EXPERIENCIA LABORAL
=============================*/
if(isset($_POST["idEditarExperienciaLaboral"])){

    $ejecutarEditar = new AjaxExperienciasLaborales();
    $ejecutarEditar->idEditarExperienciaLaboral = $_POST["idEditarExperienciaLaboral"];
    $ejecutarEditar->ajaxEditarInformacionExperienciaLaboral();

}

/*=============================
TRAER TODAS LAS EXPERIENCIAS LABORALES DE LA PERSONA
=============================*/
if(isset($_POST["idIdentificacionPersona"])){

    $traerExperiencias = new AjaxExperienciasLaborales();
    $traerExperiencias->idIdentificacionPersona = $_POST["idIdentificacionPersona"];
    $traerExperiencias->ajaxTraerExperienciasPersona();


}