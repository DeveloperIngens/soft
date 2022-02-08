<?php

class ControladorParametricas{

    /*===================================
    OBTENER DATOS REQUERIDOS
    ===================================*/
    static public function ctrObtenerDatoRequerido($tabla, $item, $valor){

        $respuesta = ModeloParametricas::mdlObtenerDatoRequerido($tabla, $item, $valor);

        return $respuesta;

    }

    /*===================================
    TRAER TIPO DOCUMENTO
    ===================================*/
    static public function ctrMostrarTiposDocumentos(){

        $tabla = "par_tipo_documento";

        $respuesta = ModeloParametricas::mdlMostrarTiposDocumentos($tabla);

        return $respuesta;

    }

    /*===================================
    TRAER PAISES
    ===================================*/
    static public function ctrMostrarPaises(){

        $tabla = "par_pais";

        $respuesta = ModeloParametricas::mdlMostrarPaises($tabla);

        return $respuesta;

    }

    /*================================
    TRAER DEPARTAMENTOS
    ==================================*/
    static public function ctrTraerDepartamentos(){

        $tabla = "par_ciudades";

        $respuesta = ModeloParametricas::mdlTraerDepartamentos($tabla);

        return $respuesta;

    }

    /*================================
    TRAER DEPARTAMENTOS INSTITUCIONES EDUCATIVAS
    ==================================*/
    static public function ctrTraerDepartamentosInstituciones(){

        $tabla = "par_instituciones_educativas";

        $respuesta = ModeloParametricas::mdlTraerDepartamentosInstituciones($tabla);

        return $respuesta;

    }

    /*================================
    OBTENER CIUDADES DEL DEPARTAMENTO SELECCIONADO
    ==================================*/
    static public function ctrObtenerCiudadesDepartamento($valor){

        $tabla = "par_ciudades";

        $respuesta = ModeloParametricas::mdlObtenerCiudadesDepartamento($tabla, $valor);

        return $respuesta;

    }

    /*================================
    OBTENER PAIS CON CODIGO
    ==================================*/
    static public function ctrObtenerPaisBuscado($codigo){

        $tabla = "par_pais";

        $respuesta = ModeloParametricas::mdlObtenerPaisBuscado($tabla, $codigo);

        return $respuesta;

    }

    /*================================
    OBTENER DEPARTAMENTO Y CIUDAD
    ==================================*/
    static public function ctrObtenerDepartamentoCiudad($campo, $buscar){

        $tabla = "par_ciudades";

        $respuesta = ModeloParametricas::mdlObtenerDepartamentoCiudad($tabla, $campo, $buscar);

        return $respuesta;

    }

    /*================================
    OBTENER SECTORES LABORALES
    ==================================*/
    static public function ctrObtenerSectoresLaborales($item, $valor){

        $tabla = "par_sectores";

        $respuesta = ModeloParametricas::mdlObtenerSectoresLaborales($tabla, $item, $valor);

        return $respuesta;

    }

    /*================================
    OBTENER NIVELES ESTUDIO
    ==================================*/
    static public function ctrObtenerNivelesEstudios($item, $valor){

        $tabla = "par_niveles_educativos";

        $respuesta = ModeloParametricas::mdlObtenerNivelesEstudios($tabla, $item, $valor);

        return $respuesta;

    }


    /*============================
    TRAER INSTITUCIONES CON ESE DEPARTAMENTO
    =============================*/
    static public function ctrObtenerInstitucionesDepartamentos($item, $valor){

        $tabla = "par_instituciones_educativas";

        $respuesta=ModeloParametricas::mdlObtenerInstitucionesDepartamentos($tabla, $item, $valor);

        return $respuesta;

    }


    /*===============================
    TRAER INSTITUCION CON ID SELECCIONADO
    ===============================*/
    static public function ctrObtenerInstitucionId($item, $valor){

        $tabla = "par_instituciones_educativas";

        $respuesta = ModeloParametricas::mdlObtenerInstitucionId($tabla, $item, $valor);

        return $respuesta;


    }

}