<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;

class ModeloParametricasCor {

    /*=====================
    ACTUALIZAR CONCECUTIVO
    ======================*/
    static public function mdlActualizarConcecutivo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero_concecutivo = :numero_concecutivo WHERE id_proyecto =  :id_proyecto");

        $stmt->bindParam(":numero_concecutivo", $datos["numero_concecutivo"], PDO::PARAM_STR);

        $stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt -> close();

        $stmt = null;

    }

    /*===============================
    TRAER PROYECTOS DE LA AREA
    ===============================*/
    static public function mdlTraerDatoRequeridoTodos($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

    }


    /*============================
    EDITAR PROYECTO
    ==============================*/
    static public function mdlEditarProyecto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_proyecto = :nombre_proyecto, prefijo_proyecto = :prefijo_proyecto, id_responsable = :id_responsable WHERE id_proyecto = :id_proyecto");

        $stmt->bindParam(":nombre_proyecto", $datos["nombre_proyecto"], PDO::PARAM_STR);
        $stmt->bindParam(":prefijo_proyecto", $datos["prefijo_proyecto"], PDO::PARAM_STR);
        $stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_STR);
        $stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt -> close();

		$stmt = null;

    }


    /*============================
    CREAR PROYECTO
    ==============================*/
    static public function mdlCrearProyecto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_proyecto, prefijo_proyecto, id_responsable, numero_concecutivo) VALUES (:nombre_proyecto, :prefijo_proyecto, :id_responsable, :numero_concecutivo)");

        $stmt->bindParam(":nombre_proyecto", $datos["nombre_proyecto"], PDO::PARAM_STR);
        $stmt->bindParam(":prefijo_proyecto", $datos["prefijo_proyecto"], PDO::PARAM_STR);
        $stmt->bindParam(":id_responsable", $datos["id_responsable"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_concecutivo", $datos["numero_concecutivo"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return $stmt->errorInfo();

        }

        $stmt -> close();

		$stmt = null;

    }



    /*============================
    CREAR AREA
    ==============================*/
    static public function mdlCrearArea($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_area, descripcion_area) VALUES (:nombre_area, :descripcion_area)");

        $stmt->bindParam(":nombre_area", $datos["nombre_area"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_area", $datos["descripcion_area"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        }

        $stmt -> close();

		$stmt = null;

    }

    /*============================
    OBTENER DATO REQUERIDO
    ==============================*/
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

    /*===============================
    ELIMINAR AREA
    ================================*/
    static public function mdlEliminarDatoRequerido($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = $valor");

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}