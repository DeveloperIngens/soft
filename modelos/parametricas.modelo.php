<?php

require_once "conexion.php";

class ModeloParametricas{

    /*===================================
    OBTENER DATOS REQUERIDOS
    ===================================*/
    static public function mdlObtenerDatoRequerido($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*===================================
    TRAER TIPO DOCUMENTO
    ===================================*/
    static public function mdlMostrarTiposDocumentos($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    /*===================================
    TRAER PAISES
    ===================================*/
    static public function mdlMostrarPaises($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT cod_pais, pais FROM $tabla ORDER BY pais ASC");

        $stmt -> execute();

        return $stmt->fetchAll();

        $stmt -> close();

        $stmt = null;

    }

    /*================================
    TRAER DEPARTAMENTOS
    ==================================*/
    static public function mdlTraerDepartamentos($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT cod_dep, departamento FROM $tabla GROUP BY departamento ORDER BY departamento ASC");

        $stmt -> execute();

        return $stmt->fetchAll();

        $stmt -> close();

        $stmt = null;

    }

    /*================================
    TRAER DEPARTAMENTOS INSTITUCIONES
    ==================================*/
    static public function mdlTraerDepartamentosInstituciones($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT ciudad FROM $tabla GROUP BY ciudad ORDER BY ciudad ASC");

        $stmt -> execute();

        return $stmt->fetchAll();

        $stmt -> close();

        $stmt = null;

    }

    /*================================
    OBTENER CIUDADES DEL DEPARTAMENTO SELECCIONADO
    ==================================*/
    static public function mdlObtenerCiudadesDepartamento($tabla, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT cod_ciudad, ciudad FROM $tabla WHERE cod_dep = $valor");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

    }

    /*================================
    OBTENER PAIS CON CODIGO
    ==================================*/
    static public function mdlObtenerPaisBuscado($tabla, $codigo){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE cod_pais = '$codigo'");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

    }

    /*================================
    OBTENER DEPARTAMENTO Y CIUDAD
    ==================================*/
    static public function mdlObtenerDepartamentoCiudad($tabla, $campo, $buscar){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $campo = '$buscar'");

        $stmt->execute();

        return $stmt->fetch();

        $stmt -> close();

        $stmt = null;

    }

    /*================================
    OBTENER SECTORES LABORALES
    ==================================*/
    static public function mdlObtenerSectoresLaborales($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*================================
    OBTENER SECTORES LABORALES
    ==================================*/
    static public function mdlObtenerNivelesEstudios($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*============================
    TRAER INSTITUCIONES CON ESE DEPARTAMENTO
    =============================*/
    static public function mdlObtenerInstitucionesDepartamentos($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY nombre ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


    }


    /*===============================
    TRAER INSTITUCION CON ID SELECCIONADO
    ===============================*/
    static public function mdlObtenerInstitucionId($tabla, $item, $valor){

        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

    }

}