<?php

require_once "../controladores/hoja-vida.controlador.php";
require_once "../modelos/hoja-vida.modelo.php";
require_once "../controladores/parametricas.controlador.php";
require_once "../modelos/parametricas.modelo.php";

class AjaxNivelesEstudios {

    /*=============================
    VER NIVEL ESTUDIO
    =============================*/
    public $idNivelEstudioVer;

    public function ajaxVerInformacionNivelEstudio(){

        $item = "id_nivel_estudio";
        $valor = $this->idNivelEstudioVer;

        $infoNivelEstudio = ControladorHojaVida::ctrVerNivelesEstudios($item, $valor);

        echo json_encode($infoNivelEstudio);
        
    }

    /*============================
    TRAER DEPARTAMENTO INSTITUCION EDUCATIVA
    =============================*/
    public $idDInstitucion;

    public function ajaxMostrarDepartamentoInstitucion(){

        $tabla = "par_instituciones_educativas";
        $item = "id_institucion";
        $valor = $this->idDInstitucion;

        $DepInstituciones = ControladorParametricas::ctrObtenerDatoRequerido($tabla, $item, $valor);

        echo json_encode($DepInstituciones);

    }


    /*=============================
    TRAER TODAS LAS FORMACIONES DE LA PERSONA
    =============================*/
    public $idIdentificacionPersona;

    public function ajaxTraerNivelesEstudiosPersona(){

        $item = "identificacion_fk";
        $valor = $this->idIdentificacionPersona;

        $formacionesPersona = ControladorHojaVida::ctrTraerNivelesEstudiosPersona($item, $valor);

        $cadenaFormacion = "";

        foreach($formacionesPersona as $key => $valueFormacionPersona){

            $itemNivelEducativo = "id_nivel";
            $valorNivelEducativo = $valueFormacionPersona["id_nivel_educativo"];

            $nivelEducativo = ControladorParametricas::ctrObtenerNivelesEstudios($itemNivelEducativo, $valorNivelEducativo);


            $itemInstitucion = "id_institucion";
            $valorInstitucion = $valueFormacionPersona["institucion_educativa_id"];

            $institucionEducativa = ControladorParametricas::ctrObtenerInstitucionId($itemInstitucion, $valorInstitucion);

            if($nivelEducativo["nombre_nivel"] == "Bachillerato"){

                $cadenaFormacion .= '<div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title"><b>Formación '.$nivelEducativo["nombre_nivel"].'</b></h3>

                        <hr>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Titulo Otorgado: </label> '. $valueFormacionPersona["titulo_obtenido"].

                                '</div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Fecha de Grado: </label> '. $valueFormacionPersona["fecha_finalizacion"].

                                '</div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Institución Educativa: </label> '.$valueFormacionPersona["institucion_secundaria"].'
                                
                                </div>

                            </div>
                        
                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Adjunto:</label> <a href="'.$valueFormacionPersona["adjunto_diploma"].'" target="_blank">Archivo Adjunto</a>
                                
                                </div>
                            
                            </div>
                        
                        </div>

                    </div>

                </div>';

            }

            if($nivelEducativo["nombre_nivel"] == "Técnico Laboral"){


                $cadenaFormacion .= '<div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title"><b>Formación '.$nivelEducativo["nombre_nivel"].'</b></h3>

                        <hr>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Titulo Otorgado: </label> '. $valueFormacionPersona["titulo_obtenido"].

                                '</div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Fecha de Grado: </label> '. $valueFormacionPersona["fecha_finalizacion"].

                                '</div>

                            </div>

                        
                        </div>

                        <div class="row">';

                            if($valueFormacionPersona["institucion_educativa_id"] != null){

                                $cadenaFormacion .= '<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento Institución Educativa:</label> '.$institucionEducativa["ciudad"].'
                                    </div>
                                </div>';

                                $cadenaFormacion .= '<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento Institución Educativa:</label> '.$institucionEducativa["nombre"].'
                                    </div>
                                </div>';

                            }else if($valueFormacionPersona["institucion_educativa_otro"] != ""){

                                $cadenaFormacion .= '<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Institución Educativa:</label> '.$valueFormacionPersona["institucion_educativa_otro"].'
                                    </div>
                                </div>';

                            }
                        
                        $cadenaFormacion .= '</div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Adjunto Diploma/Acta: </label> '.$valueFormacionPersona["documento_adjunto"].'
                                
                                </div>
                            
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Adjunto:</label> <a href="'.$valueFormacionPersona["adjunto_diploma"].'" target="_blank">Archivo Adjunto</a>
                                
                                </div>
                            
                            </div>
                        
                        </div>

                    </div>

                </div>';


            }

            if($nivelEducativo["nombre_nivel"] == "Formación Tec profesional" || $nivelEducativo["nombre_nivel"] == "Tecnológica" || $nivelEducativo["nombre_nivel"] == "Especialización" || $nivelEducativo["nombre_nivel"] == "Maestría" || $nivelEducativo["nombre_nivel"] == "Doctorado" || $nivelEducativo["nombre_nivel"] == "Estudios no Formales"){

                $cadenaFormacion .= '<div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title"><b>Formación '.$nivelEducativo["nombre_nivel"].'</b></h3>

                        <hr>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Titulo Otorgado: </label> '. $valueFormacionPersona["titulo_obtenido"].

                                '</div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Fecha de Grado: </label> '. $valueFormacionPersona["fecha_finalizacion"].

                                '</div>

                            </div>

                        
                        </div>

                        <div class="row">';

                            if($valueFormacionPersona["institucion_educativa_id"] != null){

                                $cadenaFormacion .= '<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento Institución Educativa:</label> '.$institucionEducativa["ciudad"].'
                                    </div>
                                </div>';

                                $cadenaFormacion .= '<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento Institución Educativa:</label> '.$institucionEducativa["nombre"].'
                                    </div>
                                </div>';

                            }else if($valueFormacionPersona["institucion_educativa_otro"] != ""){

                                $cadenaFormacion .= '<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Institución Educativa:</label> '.$valueFormacionPersona["institucion_educativa_otro"].'
                                    </div>
                                </div>';

                            }
                        
                        $cadenaFormacion .= '</div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Adjunto Diploma/Acta: </label> '.$valueFormacionPersona["documento_adjunto"].'
                                
                                </div>
                            
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Adjunto:</label> <a href="'.$valueFormacionPersona["adjunto_diploma"].'" target="_blank">Archivo Adjunto</a>
                                
                                </div>
                            
                            </div>
                        
                        </div>

                    </div>

                </div>';

            }

            if($nivelEducativo["nombre_nivel"] == "Universitaria"){

                $cadenaFormacion .= '<div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title"><b>Formación '.$nivelEducativo["nombre_nivel"].'</b></h3>

                        <hr>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Titulo Otorgado: </label> '. $valueFormacionPersona["titulo_obtenido"].

                                '</div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Fecha de Grado: </label> '. $valueFormacionPersona["fecha_finalizacion"].

                                '</div>

                            </div>

                        
                        </div>

                        <div class="row">';

                            if($valueFormacionPersona["institucion_educativa_id"] != null){

                                $cadenaFormacion .= '<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento Institución Educativa:</label> '.$institucionEducativa["ciudad"].'
                                    </div>
                                </div>';

                                $cadenaFormacion .= '<div class="col-md-6">
                                    <div class="form-group">
                                        <label>Departamento Institución Educativa:</label> '.$institucionEducativa["nombre"].'
                                    </div>
                                </div>';

                            }else if($valueFormacionPersona["institucion_educativa_otro"] != ""){

                                $cadenaFormacion .= '<div class="col-md-12">
                                    <div class="form-group">
                                        <label>Institución Educativa:</label> '.$valueFormacionPersona["institucion_educativa_otro"].'
                                    </div>
                                </div>';

                            }
                        
                        $cadenaFormacion .= '</div>';    

                        $cadenaFormacion .= '<div class="row">';

                            if($valueFormacionPersona["adjunto_tarjeta_profesional"] != null){

                                $cadenaFormacion .=
    
                                '
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Adjunto Tarjeta Profesional:</label> <br><a href="'.$valueFormacionPersona["adjunto_tarjeta_profesional"].'" target="_blank">Archivo Adjunto</a>
                                    </div>
                                </div>';
    
                            }
    
                            if($valueFormacionPersona["fecha_expedicion_tarjeta"] != null){
    
                                $cadenaFormacion .=
    
                                '
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha EXP. Tarjeta Profesional:</label> '.$valueFormacionPersona["fecha_expedicion_tarjeta"].'
                                    </div>
                                </div>';
    
                            }
    
                            if($valueFormacionPersona["fecha_finalizacion_materias"] != null){
    
                                $cadenaFormacion .=
    
                                '
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha Terminación Materias:</label> '.$valueFormacionPersona["fecha_finalizacion_materias"].'
                                    </div>
                                </div>';
    
                            }
                            
                        $cadenaFormacion .= '</div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Adjunto Diploma/Acta: </label> '.$valueFormacionPersona["documento_adjunto"].'
                                
                                </div>
                            
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Adjunto:</label> <a href="'.$valueFormacionPersona["adjunto_diploma"].'" target="_blank">Archivo Adjunto</a>
                                
                                </div>
                            
                            </div>
                        
                        </div>

                    </div>

                </div>';


            }

        }

        echo $cadenaFormacion;


    }


}

/*=============================
VER NIVEL ESTUDIO
=============================*/
if(isset($_POST["idNivelEstudioVer"])){

    $verInfo = new AjaxNivelesEstudios();
    $verInfo->idNivelEstudioVer = $_POST["idNivelEstudioVer"];
    $verInfo->ajaxVerInformacionNivelEstudio();

}

/*============================
TRAER DEPARTAMENTO INSTITUCION EDUCATIVA
=============================*/
if(isset($_POST["idDepartamentoInstitucion"])){

    $dInstitucion = new AjaxNivelesEstudios();
    $dInstitucion->idDInstitucion = $_POST["idDepartamentoInstitucion"];
    $dInstitucion->ajaxMostrarDepartamentoInstitucion();

}

/*=============================
TRAER TODAS LAS FORMACIONES DE LA PERSONA
=============================*/
if(isset($_POST["idIdentificacionPersona"])){

    $traerFormacion = new AjaxNivelesEstudios();
    $traerFormacion->idIdentificacionPersona = $_POST["idIdentificacionPersona"];
    $traerFormacion->ajaxTraerNivelesEstudiosPersona();

}
