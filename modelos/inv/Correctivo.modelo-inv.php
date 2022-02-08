<?php

$ruta = $_SERVER["DOCUMENT_ROOT"]."/soft/modelos/conexion.php";

require_once $ruta;

class ModeloCorrectivo{


	/*=============================================
	OBTENER DATO REQUERIDO TABLA
	=============================================*/
	static public function mdlObternerDatoRequerido($tabla, $item, $valor){

		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR);

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
	MOSTRAR MANTENIMIENTOS CORRECTIVOS
	=============================================*/
	static public function MdlMostrarCorrectivo($tabla , $item , $valor ){
		
		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = :$item");
			
			$stmt -> bindParam(":". $item,$valor, PDO::PARAM_STR);

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


    /*==================================
	CREAR MANTENIMIENTO PREVENTIVO/CORRECTIVO 
	=============================================*/
	static public function mdlIngresarCorrectivo($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_mantenimiento, tipo , tipo_mantenimiento, id_usuario_creacion, id_categoria) VALUES (:nombre_mantenimiento , :tipo, :tipo_mantenimiento, :id_usuario_creacion, :id_categoria)");

		$stmt->bindParam(":nombre_mantenimiento", $datos["nombre_mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_mantenimiento", $datos["tipo_mantenimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $datos["id_usuario_creacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}	

	/*=============================================
	EDITAR MANTENIMIENTO PREVENTIVO/CORRECTIVO 
	=============================================*/
	static public function mdlEditarCorrectivo($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_mantenimiento=:nombre_mantenimiento , tipo=:tipo , tipo_mantenimiento=:tipo_mantenimiento, id_categoria = :id_categoria  WHERE id_tipo_mantenimiento=:id_tipo_mantenimiento");

		$stmt -> bindParam(":nombre_mantenimiento",$datos["nombre_mantenimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo",$datos["tipo"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo_mantenimiento",$datos["tipo_mantenimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_categoria",$datos["id_categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_tipo_mantenimiento",$datos["id_tipo_mantenimiento"], PDO::PARAM_INT);

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

	static public function mdlActualizarTecnologia($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR MANTENIMIENTO PREVENTIVO/CORRECTIVO 
	=============================================*/
	static public function mdlBorrarCorrecctivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0 WHERE id_tipo_mantenimiento = :id_tipo_mantenimiento");

		$stmt -> bindParam(":id_tipo_mantenimiento", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}
}
