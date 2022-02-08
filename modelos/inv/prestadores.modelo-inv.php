<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;

class ModeloPrestadores{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function MdlMostrarActivos($tabla , $item , $valor){

		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR ,PDO::PARAM_INT);

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

	/*=============================================
	REGISTRO DE ACTIVOS 
	=============================================*/

	static public function mdlIngresarActivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (bien , tipo , numero_placa , estado_activo , valor_activo ) VALUES(:bien , :tipo , :numero_placa , :estado_activo , :valor_activo )");		

		$stmt->bindParam(":bien", $datos["bien"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
		$stmt->bindParam(":numero_placa", $datos["numero_placa"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_activo", $datos["estado_activo"], PDO::PARAM_INT);
		$stmt->bindParam(":valor_activo", $datos["valor_activo"], PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	

	/*=============================================
	EDITAR ACTIVO
	=============================================*/

	static public function mdlEditarActivo($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET bien=:bien , tipo=:tipo , numero_placa=:numero_placa , estado_activo=:estado_activo , valor_activo=:valor_activo WHERE id_activos=:id_activos");



		$stmt -> bindParam(":bien",$datos["bien"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo",$datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_placa",$datos["numero_placa"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado_activo",$datos["estado_activo"], PDO::PARAM_INT);
		$stmt -> bindParam(":valor_activo",$datos["valor_activo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_activos",$datos["id_activos"], PDO::PARAM_INT);	

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/

	static public function mdlActualizarActivo($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR ACTIVO
	=============================================*/

	static public function mdlBorrarActivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_activos = :id_activos");

		$stmt -> bindParam(":id_activos", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

		static public function mdlMostrarPerfilesactivo($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE perfil !='administrador';");

		$stmt -> execute();

		return $stmt -> fetchAll();		

		$stmt -> close();

		$stmt = null;

	}


}
