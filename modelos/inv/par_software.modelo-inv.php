<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;

class ModeloSoftware{

	/*=============================================
	MOSTRAR MANTENIMIENTOS CORRECTIVOS
	=============================================*/

	static public function MdlMostrarSoftware($tabla , $item , $valor ){
		
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
}